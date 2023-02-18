<?php

namespace frontend\controllers;

use common\models\Contacto;
use common\models\Documento;
use common\models\Domicilio;
use common\models\Expediente;
use common\models\Persona;
use common\models\SolicitudConstruccion;
use common\models\SolicitudConstruccionHasDocumento;
use common\models\SolicitudConstruccionHasPersona;
use common\models\SolicitudConstruccionSearch;
use common\models\TipoTramiteHasDocumento;
use common\models\TipoTramite;
use common\models\User;
use PDO;
use PDOException;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
/**
 * SolicitudConstruccionController implements the CRUD actions for SolicitudConstruccion model.
 */
class SolicitudConstruccionController extends Controller
{
     /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [ 
            'access'=> [   
                'class' => AccessControl::class,
                'rules'=> [
                    [
                        'actions' => ['view','create','update','delete', 'index',"formrecibodoc",'printsolicitud'],
                        'allow' => true,
                        'roles' => ['@'],
                        /* 'matchCallback' => function ($rule, $action) {
                               ob_start();  
                               var_dump("VIVIVI");  
                               var_dump($action); 
                             Yii::debug(ob_get_clean(),);  
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        } */
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    private function checkAccessExpediente($exp){        
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
                return Expediente::findOne(["id_User_CreadoPor"=> $userSrc->id])?true:false;
                break;
            default:
                return false;
                break;
        }

    }

    /* 
    Este action deberá ser llamado desde ExpedientesController.
    Aqui decidirá si la solicitud del expediente irá a edición o creación.
    */
    public function actionIndex($exp){

        $haveAcces = $this->checkAccessExpediente($exp);
        if(!$haveAcces) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        $soliConstruccion = SolicitudConstruccion::findOne(["id_Expediente" => $exp]);

        if($soliConstruccion){
                return $this->redirect(['update', 'exp' => $soliConstruccion->id_Expediente]);//id_Expediente en teoria siempre será el mismo que -> $exp

        }else{//no existe solicitud, entonces redirige a crear una.
            return $this->redirect(['create', 'exp' => $exp]);
        }

    }
    /**
     * Lists all SolicitudConstruccion models.
     *
     * @return string
     * @deprecated
     */
    private function actionIndexDeprecated()
    {
        /* $searchModel = new SolicitudConstruccionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); */
    }

    /**
     * Displays a single SolicitudConstruccion model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    private function multi_implode($array, $glue)
    {
        $ret = '';

        foreach ($array as $item) {
            if (is_array($item)) {
                $ret .= $this->multi_implode($item, $glue) . $glue;
            } else {
                $ret .= $item . $glue;
            }
        }

        $ret = substr($ret, 0, 0 - strlen($glue));

        return $ret;
    }
    /**
     * Creates a new SolicitudConstruccion model.
     * If creation is successful, the browser will be redirected to the 'X' page.
     * @return string|\yii\web\Response
     */
    //Debe traer el id de expediente
    public function actionCreate($exp)
    {
        $haveAcces = $this->checkAccessExpediente($exp);
        if(!$haveAcces) return $this->redirect(['site/error', 'message' =>"La página no existe o no tiene acceso."]); 
        /* Si existe, hace redirect a update, sino,  */
        $CREATE_SOLI_EXPEDIENTE_NUMBER = $exp;

        if(!Expediente::findOne(["id"=>$CREATE_SOLI_EXPEDIENTE_NUMBER])){
            Yii::$app->session->setFlash('success', 'Expediente no existe');
            return $this->redirect(['expedientes/index']);
        }  
        //si ya hay solicitud con ese expediente, redirije a editarlo
        if(SolicitudConstruccion::findOne(["id_Expediente"=>$exp]))  
            return $this->redirect(['solicitud-construccion/update']);


        $modelSolicitudConstruccion = new SolicitudConstruccion();

        $propietarioPersona     = new Persona(); //debería ser un array, por ahora lo dejo así
        $soliDomicilioNotif     = new Domicilio();
        $soliDomicilioPredio    = new Domicilio();
        $multiplesDomicilio     = [$soliDomicilioNotif, $soliDomicilioPredio];
        $soliContacto           = new Contacto();
        $soliHasDocuments       = [];  

        if ($this->request->isPost) {
 
           
           //crea modelos vacios, para luego cargarlos
            foreach ($this->request->post('SolicitudConstruccionHasDocumento') as $key => $value/* modelo de soliHasDoc */) {

                $soliHasDocuments[$key] = new SolicitudConstruccionHasDocumento();
                /*Los documentos están ligados a una solicitud de construcción, en este accion, esa solicitud se crea, y este id asignado es ignorado, solamente se coloca para validacion */
               /*  $soliHasDocuments[$key]->id_SolicitudConstruccion = -1; */
                 $soliHasDocuments[$key]->scenario = SolicitudConstruccionHasDocumento::SCENARIO_CREATE;
                
               
            }
            $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;
            //Siempre cargar primero, después se valida, ya que si la validación de un modeelo falla y enseguida seguia un LOAD, ese load no será ejecutado y el retorno al view será nulo
            if (
                $modelSolicitudConstruccion->load($this->request->post()) &&
                $propietarioPersona->load($this->request->post()) &&
                $soliContacto->load($this->request->post()) &&
                Domicilio::loadMultiple(
                    $multiplesDomicilio,
                    $this->request->post()
                ) && 
                SolicitudConstruccionHasDocumento::loadMultiple(
                    $soliHasDocuments,
                    $this->request->post()
                    )
                && Domicilio::validateMultiple($multiplesDomicilio)
                && SolicitudConstruccionHasDocumento::validateMultiple($soliHasDocuments)
            ) {

                Yii::$app->session->setFlash('success', 'Solicitud válida');
                 
                if($modelSolicitudConstruccion -> id_DirectorResponsableObra == 0){
                    
                    $modelSolicitudConstruccion -> id_DirectorResponsableObra = null;
                }
                if($modelSolicitudConstruccion -> id_CorrSeguridadEstruc == 0){
                    $modelSolicitudConstruccion -> id_CorrSeguridadEstruc = null;
                }
                if($modelSolicitudConstruccion -> id_SubGeneroConstruccion == 0){
                    $modelSolicitudConstruccion -> id_SubGeneroConstruccion = null;
                }


                //Yii::$app->session->setFlash('warning', "nombreArchivo1:".$soliHasDocuments[0] -> nombreArchivo);
                $result = $modelSolicitudConstruccion ->createSolicitudExpediente (
                                $propietarioPersona,  
                                $soliDomicilioNotif ,
                                $soliDomicilioPredio,
                                $soliContacto,  
                                $soliHasDocuments,
                                Yii::$app->user->identity->id   
                );
                Yii::$app->session->setFlash($result["success"]?'success':'error',$result["MSG"]);

                if($result["success"]){
                    return $this->redirect(['solicitud-construccion/update',"exp"=>$CREATE_SOLI_EXPEDIENTE_NUMBER]);                    
                }
                //else //no redirect
                //return $this->redirect(['solicitud-construccion/create',"exp"=>$CREATE_SOLI_EXPEDIENTE_NUMBER]);
                //aun si se redirecciona a create, se irá a update, porque ya existe solicitud
            }
        } else {
            //cuando no es post
            $modelSolicitudConstruccion->loadDefaultValues();
            $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;
            $modelSolicitudConstruccion->id_User_ModificadoPor = -1;
            $modelSolicitudConstruccion->id_User_ModificadoPor = -1;
            $modelSolicitudConstruccion->fechaCreacion = gmdate( 'Y-m-d\TH:i:s\Z' );
            $modelSolicitudConstruccion->fechaModificacion = gmdate( 'Y-m-d\TH:i:s\Z');
            $modelSolicitudConstruccion->id_Contacto = -1; 
            $modelSolicitudConstruccion->id_DomicilioNotificaciones = -1; 
            $modelSolicitudConstruccion->id_DomicilioPredio = -1; 
            $soliContacto->id = -1;
            $soliDomicilioNotif -> id = -1;
            $soliDomicilioPredio -> id = -1;
            //los docs availables solo la primera vez (cuando se hace un GET), luego el usuario podrá descartar los que no ocupe☺
            $docsAvailableForCurrTraMite = TipoTramiteHasDocumento::findAll([
                'id_TipoTramite' => Expediente::findOne([
                    'id' => $CREATE_SOLI_EXPEDIENTE_NUMBER,
                ])->id_TipoTramite,
            ]);

            foreach ($docsAvailableForCurrTraMite as $index => $currAvailable) {
                $currSoliHasDocument = new SolicitudConstruccionHasDocumento();
                $currSoliHasDocument->id_Documento =  $currAvailable->id_Documento/* *84 */;
                // $currSoliHasDocument->documento = $currAvailable ->documento;
                $currSoliHasDocument->isEntregado = true;
                $currSoliHasDocument->nombreArchivo = "Sin nombre $currAvailable->id_Documento";
                $currSoliHasDocument->path = 'Sin path';
                $currSoliHasDocument->realNombreArchivo = 'Sin nombre real';
                $soliHasDocuments[$index] = $currSoliHasDocument; //crea nuevo en posición index
            }
        }

        return $this->render('create', [
            'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
            'propietarioPersona' => $propietarioPersona,
            'soliDomicilioNotif' => $multiplesDomicilio[0],
            'soliDomicilioPredio' => $multiplesDomicilio[1],
            'soliContacto' => $soliContacto,
            'soliHasDocuments' => $soliHasDocuments,
        ]);
    }

    /**
     * Updates an existing SolicitudConstruccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($exp)
    {
        $haveAcces = $this->checkAccessExpediente($exp);
        if(!$haveAcces) return $this->redirect(['site/error', 'uwu' =>"La página no existe o no tiene acceso."]); 
        $UPDATE_SOLI_EXPEDIENTE_NUMBER = $exp;

        if(!Expediente::findOne(["id"=>$UPDATE_SOLI_EXPEDIENTE_NUMBER])){
            Yii::$app->session->setFlash('success', 'Expediente no existe');
            return $this->redirect(['expedientes/index']);
        }  

        //Si no existe , redirije a crearlo
        if(!SolicitudConstruccion::findOne(["id_Expediente"=>$exp]))  
            return $this->redirect(['solicitud-construccion/create']);

            

        $modelSolicitudConstruccion = new SolicitudConstruccion();

        $propietarioPersona     = new Persona(); //debería ser un array, por ahora lo dejo así
        $soliDomicilioNotif     = new Domicilio();
        $soliDomicilioPredio    = new Domicilio();
        $multiplesDomicilio     = [$soliDomicilioNotif, $soliDomicilioPredio];
        $soliContacto           = new Contacto();
        $soliHasDocuments       = [];  

        if ($this->request->isPost) {
           // Yii::debug("ispost alv", $category = __METHOD__);
            //crea modelos vacios, para luego cargarlos

            foreach ($this->request->post('SolicitudConstruccionHasDocumento') as $key => $value/* modelo de soliHasDoc */) {

                $soliHasDocuments[$key] = new SolicitudConstruccionHasDocumento();
                /*Los documentos están ligados a una solicitud de construcción, en este accion, esa solicitud se crea, y este id asignado es ignorado, solamente se coloca para validacion */
               // $soliHasDocuments[$key]->id_SolicitudConstruccion = -1;
                
               
            }
           // Yii::debug("BEF SET EXPED number FORICH", $category = __METHOD__);
            $modelSolicitudConstruccion->id_Expediente = $UPDATE_SOLI_EXPEDIENTE_NUMBER;
            Yii::debug("AFTEr SET EXPED number FORICH", $category = __METHOD__);
            
            if (
                $modelSolicitudConstruccion->load($this->request->post()) &&
                $propietarioPersona->load($this->request->post()) &&
                $soliContacto->load($this->request->post()) &&
                Domicilio::loadMultiple(
                    $multiplesDomicilio,
                    $this->request->post()
                ) &&
                Domicilio::validateMultiple($multiplesDomicilio) &&
                SolicitudConstruccionHasDocumento::loadMultiple(
                    $soliHasDocuments,
                    $this->request->post()
                )
               // && SolicitudConstruccionHasDocumento::validateMultiple($soliHasDocuments)
            ) {
                //Yii::$app->session->setFlash('success', 'GOOD:');
                
                //al llamar el sp, los id son ignorados
                if($modelSolicitudConstruccion -> id_DirectorResponsableObra == 0){
                    
                    $modelSolicitudConstruccion -> id_DirectorResponsableObra = null;
                }
                if($modelSolicitudConstruccion -> id_CorrSeguridadEstruc == 0){
                    $modelSolicitudConstruccion -> id_CorrSeguridadEstruc = null;
                }
                if($modelSolicitudConstruccion -> id_SubGeneroConstruccion == 0){
                    $modelSolicitudConstruccion -> id_SubGeneroConstruccion = null;
                }


                //Yii::$app->session->setFlash('warning', "nombreArchivo1:".$soliHasDocuments[0] -> nombreArchivo);
                $resUpdate = $modelSolicitudConstruccion ->updateSolicitudExpediente (
                                $propietarioPersona,  
                                $soliDomicilioNotif ,
                                $soliDomicilioPredio,
                                $soliContacto,  
                                $soliHasDocuments,
                                Yii::$app->user->identity->id   
                );
                
                if($resUpdate["success"] ==true){
                    
                    Yii::$app->session->setFlash('success', "Solicitud Actualizada.");
                    //return $this->redirect(['https://www.google.com.mx'/* , 'id' => $modelSolicitudConstruccion->id */]);
                  /*   return $this->goHome(); */
                }else{
                    Yii::$app->session->setFlash('danger',   $resUpdate["MSG"]  );
                   
                }
                
                //return $this->redirect(['expedientes/index'/* , 'id' => $modelSolicitudConstruccion->id */]);
            }


        } else {
            //cuando no es post significa renderizar los datos actuales del modelo. para su edición
            $modelSolicitudConstruccion = SolicitudConstruccion::findOne(["id_Expediente" => $UPDATE_SOLI_EXPEDIENTE_NUMBER]);
            
            ob_start();
            var_dump($modelSolicitudConstruccion );
            Yii::debug(ob_get_clean(),__METHOD__);
            if(!$modelSolicitudConstruccion){
                /* return $this->redirect(['error']); */

            }
            //SI NO EXISTE, HACER ALGO
            
            //por ahora solo soporta 1 propietario.
            $propietarioPersona = $modelSolicitudConstruccion->solicitudConstruccionHasPersonas[0]->persona;             
            $soliDomicilioNotif  =  $modelSolicitudConstruccion->domicilioNotificaciones;
            $soliDomicilioPredio =  $modelSolicitudConstruccion->domicilioPredio;
            $multiplesDomicilio  = [$soliDomicilioNotif, $soliDomicilioPredio];
            $soliContacto        = $modelSolicitudConstruccion->contacto;
            $soliHasDocuments    =  $modelSolicitudConstruccion->solicitudConstruccionHasDocumentos;


        }

        return $this->render('update', [
            'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
            'propietarioPersona' => $propietarioPersona,
            'soliDomicilioNotif' => $multiplesDomicilio[0],
            'soliDomicilioPredio' => $multiplesDomicilio[1],
            'soliContacto' => $soliContacto,
            'soliHasDocuments' => $soliHasDocuments,
        ]);
         
    }

    public function actionFormrecibodoc($exp){

        $expediente = Expediente::findOne(["id" => $exp]);

        /*     if(!$expediente){

                    return $this->redirect(["site/error",
                            [
                            "name"=> "Error al buscar expediente.",
                            "message"=>"No fue posible encontrar el expediente solicitdado."
                            ]
                        ]
                    );
                }
        */
        $solicitudConstruccion = SolicitudConstruccion::findOne(["id_Expediente" =>  $expediente->id]);

        $soliHasDocuments  =  $solicitudConstruccion->solicitudConstruccionHasDocumentos;

        return $this->render("formrecibodoc",
            ["expediente" => $expediente,
            "solicitudConstruccion"=> $solicitudConstruccion,
            "soliHasDocuments"=> $soliHasDocuments]
        );

    }


    public function actionPrintsolicitud($exp){
        $expediente = Expediente::findOne(["id" => $exp]);
        $solicitudConstruccion = SolicitudConstruccion::findOne(["id_Expediente" =>  $expediente->id]);

        $soliHasDocuments  =  $solicitudConstruccion->solicitudConstruccionHasDocumentos;


        return $this->render("printsolicitud",
            ["expediente" => $expediente,
            "solicitudConstruccion"=> $solicitudConstruccion,
            "soliHasDocuments"=> $soliHasDocuments]
        );

    }

    public function actionImprimible($exp){
        $expediente = Expediente::findOne(["id" => $exp]);
        $solicitudConstruccion = SolicitudConstruccion::findOne(["id_Expediente" =>  $expediente->id]);

        $soliHasDocuments  =  $solicitudConstruccion->solicitudConstruccionHasDocumentos;

        return $this->render("imprimible",
            ["expediente" => $expediente,
            "solicitudConstruccion"=> $solicitudConstruccion,
            "soliHasDocuments"=> $soliHasDocuments]
        );
    }

    public function actionReport() {
        // get your HTML raw content without any layouts or scripts
        $expediente = Expediente::findOne(["id" => 1]);
        $solicitudConstruccion = SolicitudConstruccion::findOne(["id_Expediente" =>  $expediente->id]);

        $soliHasDocuments  =  $solicitudConstruccion->solicitudConstruccionHasDocumentos;

        $content = $this->renderPartial('_reportView', 
            ["expediente" => $expediente,
            "solicitudConstruccion"=> $solicitudConstruccion,
            "soliHasDocuments"=> $soliHasDocuments]
        );
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            //'cssFile' => '@frontend/views/solicitud-construccion/style.css',
            // any css to be embedded if required
/*             'cssInline' => "
                .recibo-doc{

                    outline: solid 1px black;
                    font-size: 12px;
                    background-red: red;
                } ",  */
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }


    public function actionTvp(){


        $image1 = "asdasd";
        $image2 = "asdasd";
        $image3 = "asdasd";

        $items = [
            ['0062836700', 367, "2009-03-12", 'AWC Tee Male Shirt', '20.75', $image1],
            ['1250153272', 256, "2017-11-07", 'Superlight Black Bicycle', '998.45', $image2],
            ['1328781505', 260, "2010-03-03", 'Silver Chain for Bikes', '88.98', $image3],
        ];

        // Create a TVP input array
        $tvpType = 'TVPParam';
        $tvpInput = array($tvpType => $items);

        // To execute the stored procedure, either execute a direct query or prepare this query:
        $callTVPOrderEntry = "{call TVPOrderEntry(:CustID, :Items, :OrdNo, :OrdDate)}";
        $custCode = 'SRV_123';
        $ordNo = 0;
        $ordDate = null;
        try {
            ob_start();
            
            $c = new PDO("sqlsrv:Server=localhost\\SDUMA_DB;Database=sduma", "sa", "vic");
            var_dump($c);
            var_dump("UWU");
            var_dump(Yii::$app->db);
            Yii::debug(ob_get_clean(),__METHOD__);
 

            $stmt = $c->prepare($callTVPOrderEntry);
            $stmt->bindParam(":CustID", $custCode);
            $stmt->bindParam(":Items", $tvpInput, PDO::PARAM_LOB);
            // 3 - OrdNo output
            $stmt->bindParam(":OrdNo", $ordNo, PDO::PARAM_INT, 10);
            // 4 - OrdDate output
            $stmt->bindParam(":OrdDate", $ordDate, PDO::PARAM_STR, 20);
            $stmt->execute();
        } catch (PDOException $ex) {
            Yii::info($ex, $category = 'ERROR Execute command.');

        }
                        /*  $stmt = sqlsrv_query($conn, $callTVPOrderEntry, $params);
        if (!$stmt) {
            print_r(sqlsrv_errors());
        }
        sqlsrv_next_result($stmt); */
    }

    /**
     * Deletes an existing SolicitudConstruccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SolicitudConstruccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SolicitudConstruccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudConstruccion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
