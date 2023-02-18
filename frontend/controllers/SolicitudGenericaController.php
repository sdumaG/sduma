<?php

namespace frontend\controllers;

use common\models\SolicitudGenerica;
use common\models\SolicitudGenerica_has_Documento;
use common\models\SolicitudGenericaSearch;
use common\models\TipoTramite;
use common\models\User;
use Exception;
use frontend\models\NuevoExpedienteForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SolicitudGenericaController implements the CRUD actions for SolicitudGenerica model.
 */
class SolicitudGenericaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,                    
                   /* 'only' => ['delete','changestate','index','view','archivoSolicitud','archivo-solicitud'], */

                    'rules' => [
                       /*  [
                            'actions' => ['signup'],
                            'allow' => true,
                            'roles' => ['?'],
                        ], */
                        [
                            'actions' => ['delete','changestate','index','view','archivoSolicitud','archivo-solicitud','imprimir-solicitud'],
                            'allow' => true,
                            'roles' => ['@'],
                        ]                             
                    ],
                ],
                
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                        'changestate' => ['POST'],
                        'index' => ['GET','POST'],
                        'view' => ['GET','POST'],
                        'archivoSolicitud'=>['GET'],
                        'archivo-solicitud'=>['GET'],
                    ],
                ],
            ]
        );
    }


    /**
     * Lists all SolicitudGenerica models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudGenericaSearch();
        $dataProvider = $searchModel 
        ->search(ArrayHelper::merge(
            $this->request->queryParams
            , ["userModel"=>Yii::$app->user->identity]
            )
        );
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudGenerica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $availableStates = $this->isEmployee() ?
             SolicitudGenerica::STATUS_SOLICITUD:
             [$model->statusSolicitud=> SolicitudGenerica::STATUS_SOLICITUD[$model->statusSolicitud]]
             ;

        return $this->render('view', [
            'model' => $model,
            "availableStates"=> $availableStates,
        ]);
    }

    
    public function actionArchivoSolicitud(){
        
        $idSolicitud = $this->request->get('solicitud');
        $documento = $this->request->get('documento');
        //$solicitud id de Solicitud vaya :v
        if(!is_numeric($idSolicitud) || intval( $idSolicitud, $base = 10)  < 1) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        
        //$documento id
        if(!is_numeric($documento) || intval( $documento, $base = 10)  < 1) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 


        $solicitud = null;
        $isEmployee = $this->isEmployee();
        
        if($isEmployee){
            $solicitud = SolicitudGenerica::findOne(["id" => $idSolicitud]);        
        }
        else{
            //El metodo solo es acceible si existe sesión, por tanto, aqui solo se revisará que la solicitud pertenece al usuario de sesion no employee
            $solicitud = SolicitudGenerica::findOne(["id" => $idSolicitud,"id_User_CreadoPor"=>Yii::$app->user->identity->id]);                
        }

        if(!$solicitud) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 


        $soliDocumentoRelation = SolicitudGenerica_has_Documento::findOne(["id_SolicitudGenerica"=>$solicitud->id,"id_Documento" => $documento]);


        //si no existe entonces los params de URL están mal.
        if(!$soliDocumentoRelation) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        
        /* id 1, significa solo entrega fisica */
        if($soliDocumentoRelation->id_Archivo == "1" || $soliDocumentoRelation->id_Archivo == 1) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        
        $archivoToRead = $soliDocumentoRelation->archivo ;

        if(!file_exists($archivoToRead->path.$archivoToRead->realNombreArchivo) ){/* ya invluye el slash inverted */
            return $this->redirect(['site/error', 'message' =>"El archivo no existe."]); 
        }

        $mimeType = mime_content_type($archivoToRead->path.$archivoToRead->realNombreArchivo);
        
        return Yii::$app->response->sendFile(
            $archivoToRead->path.$archivoToRead->realNombreArchivo,
            $archivoToRead->nombreArchivo,
            ['inline' => true]

        );
       /*  $fileContent = file_get_contents( $archivoToRead->path.$archivoToRead->realNombreArchivo ) ;
        return Yii::$app->response->sendContentAsFile($fileContent, $archivoToRead->nombreArchivo  ,  );

        */        
    }


    /* Id de solicitud */
    public function actionChangestate(){
        
        $id = $this->request->post("id");
        if(!$id) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 

        $canChangeState = $this->isEmployee();
        if(!$canChangeState) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        
        $solicitud = SolicitudGenerica::findOne(["id" => $id]);
        if(!$solicitud) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 

        $newState = $this->request->post("newState");

        if($newState == null || !is_numeric($newState)){
            Yii::$app->session->setFlash( 'danger',   "Selección incorrecta." );
            return $this->redirect(['solicitud-generica/view',"id"=>$id]);
        }
               
        if($solicitud->statusSolicitud == SolicitudGenerica::STATUS_EXPEDIENTE_GENERADO){
            //no cambios.
            Yii::$app->session->setFlash( 'danger',   "La solicitud ya cuenta con un expediente, no es posible cambiar el estado." );
            return $this->redirect(['solicitud-generica/view',"id"=>$id]);
        }

        /* Ya incluye el cambio de state */
        if($newState == SolicitudGenerica::STATUS_EXPEDIENTE_GENERADO){
                      
            $resultCreate = $this->createExpediente($solicitud->id, $newState, TipoTramite::TIPO_TRAMITE_CONSTRUCCION,Yii::$app->user->identity->id);
    
            Yii::$app->session->setFlash( $resultCreate["success"]?"success":'danger', $resultCreate["MSG"]);                            
        }else{
            $solicitud->statusSolicitud = $newState;    
        
            $resultSave = $solicitud->save();
    
            Yii::$app->session->setFlash($resultSave ?"success":'danger', $resultSave?"Cambio guardado.":"Error al guardar el estado.");
                    
        }



        return $this->redirect(['solicitud-generica/view',"id"=>$id]);


    }

    protected function createExpediente($idSolicitudGenerica,$newStatus,$tipoTramite,$idUserCreated){

        $sql ="EXEC sp_create_expediente :idSolicitudGenerica,:newStatus,:tipoTramite,:idUserCreated; ";
        $params =[
                ':idSolicitudGenerica'=>$idSolicitudGenerica,
                ':newStatus'=>$newStatus,
                ':tipoTramite'=>$tipoTramite,
                ':idUserCreated'=>$idUserCreated  ,
        ];
        $res = -1;
        try{
            $rows =  Yii::$app->db->createCommand($sql, $params) ->queryAll( );

            $res = $rows[0]["ROWS_INSERTED"] ;
           
        }
        catch(Exception $ex){
            /* Yii::info("ERROR", $category = 'Error al crear expediente.'); */
            return ["success" => false, "MSG" =>"Error al crear expediente"];
        }
        /* Yii::info($res, $category = 'Se creó el expediente para la solicitud '.$idSolicitudGenerica); */
        return ["success" => true,"MSG" => "Expediente creado."]; 
        
 
        

    }

    /* Iser UtilVic::isEmployee */
    protected static function isEmployee(){        
        $user =Yii::$app->user->identity;

        //si no hay sesión, automaticamente false.
        if(!$user) return false;
        $userSrc = User::getUserSrcTruth($user->username);


        switch ($userSrc->id_UserLevel) {
            case User::USER_LEVEL_ADMIN:
            case User::USER_LEVEL_INTERNO:
                    return true;
                break;
            default:
                return false;
                break;
        }

    }

    private function checkAccessSolicitud($idSolicitud){        
        $user =Yii::$app->user->identity;

        //si no hay sesión, automaticamente false.
        if(!$user) return false;

        $userSrc = User::getUserSrcTruth($user->username);

        switch ($userSrc->id_UserLevel) {
            case User::USER_LEVEL_ADMIN:
            case User::USER_LEVEL_INTERNO:
                    return true;
                break;
                
            case User::USER_LEVEL_EXTERNO:
                //Si es el propietario del expediente, -> true
                return SolicitudGenerica::findOne(["id_User_CreadoPor"=> $userSrc->id])?true:false;
                break;
            default:
                return false;
                break;
        }

    }

    /* 
        $id -> id SolicitudGenerica
    */  
    public function actionImprimirSolicitud($id){

        /* Checar que current usser tenga acceso a esa solicitud */
        /* Checar horario? Creo no */


        $solicitudAImprimir = SolicitudGenerica::findOne(["id"=>$id,]);
        return $this->renderPartial("_printsolicitud",
            ["solicitudAImprimir"=>$solicitudAImprimir]
        );
    }
    /**
     * Creates a new SolicitudGenerica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    private function actionCreate()
    {
        $model = new SolicitudGenerica();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SolicitudGenerica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SolicitudGenerica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SolicitudGenerica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SolicitudGenerica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudGenerica::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
