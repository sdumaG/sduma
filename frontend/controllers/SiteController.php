<?php

namespace frontend\controllers;

use common\models\Archivo;
use common\models\ConfigTramiteMotivoCuentaconDoc;
use common\models\ConstanciaEscritura;
use common\models\ConstanciaPosecionEjidal;
use common\models\Contacto;
use common\models\DirectorResponsableObra;
use common\models\Documento;
use common\models\Domicilio2;
use common\models\Escritura;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\ProbarActive;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use common\models\Persona;
use common\models\PersonaMoral;
use common\models\SolicitudConstruccion;
use common\models\SolicitudGenerica;
use common\models\SolicitudGenerica_has_Documento;
use common\models\SolicitudGenerica_has_Persona;
use common\models\SolicitudGenericaCuentaCon;
use common\models\TipoTramite;
use common\models\UploadFileVic;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup','about','segunda'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    /* [
                        'actions' => ['view','create','update','delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],//autenticados //no importa el nivel, 
                    ], */
                    [
                        'actions' => ['logout','segunda'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                    /* ,
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ], */
                     
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionSegunda(){

        $modelSolicitudGenerica = new SolicitudGenerica();
        $modelSolicitudGenerica->scenario = SolicitudGenerica::SCENARIO_CREATE_ESCRITURA_CONSTANCIA;
        $modelSolicitudGenerica->id_SolicitudGenericaCuentaCon = 1 ;
        $modelContacto = new Contacto();
        $personaSolicita = new Persona();
        $personaMoralSolicita = new PersonaMoral();

        $domicilioNotif = new Domicilio2();
        
        $modelEscritura = new Escritura();
        $modelConstanciaEscritura = new ConstanciaEscritura();
        $modelConstanciaPosecionEjidal = new ConstanciaPosecionEjidal();
        
        //documentos disponibles para la configuración de tramite
        $modelTramiteMotivoCuentaConDoc = null;/*  array(); */
        //Archivos, cada uno corresponde a un Documento (modelTramiteMotivoCuentaConDoc)
        $modelFilesRef_TramiteMotivoCuentaConDoc = array();                
        

        $modelPropietarios = array();
        $memoriaCalculoFile = new UploadFileVic(); // new UploadedFile();//file
        $mecanicaSuelosFile = new UploadFileVic();
        $licenciaConstruccionAreaPreexistenteFile = new UploadFileVic();
        $licenciaConstruccionAreaPreexistenteFile->scenario = UploadFileVic::SCENARIO_NO_MANDATORY_FILE;
        
        $domicilioPredio = new Domicilio2();
        //siempre habrá al menos 1 propietario
        $modelPropietarios[1] = new Persona();
        
        $modelDROList = DirectorResponsableObra::findAll(["isActivo"=>1]);

        $stateRequestVic ="";
        //Por default mostrará, Licencia / Escritura
        if($this->request->isGet){
            $modelTramiteMotivoCuentaConDoc = ConfigTramiteMotivoCuentaconDoc::findAll(
                [
                    "id_TipoTramite"=>1,//TipoTramite::findOne(["nombre"=>"CONTRUCCION"]) //trámite construcción
                    "id_MotivoConstruccion"=>1,
                    "id_SolicitudGenericaCuentaCon"=>1,
                    //"doc"=>1,            
                ]
            );
            foreach ($modelTramiteMotivoCuentaConDoc as $key => $curr) {
                $modelFilesRef_TramiteMotivoCuentaConDoc["$curr->id_Documento"] =  new UploadFileVic(); 
            }

            /* CONSTANCIA EJIDAL; ESCRITURA; CONSTANCIA ESCRITURA */
            $modelSolicitudGenericaCuentaConAvailables = SolicitudGenericaCuentacon::findAll(["isActivo"=>"1"]);

        }

        if($this->request->isPost){

            $modelSolicitudGenerica->load($this->request->post(),"SolicitudGenerica");
            if($modelSolicitudGenerica->id_MotivoConstruccion == 2){//Si selecciona Registro
                $modelSolicitudGenericaCuentaConAvailables = SolicitudGenericaCuentacon::findAll(["id"=>"3","isActivo"=>"1"]);
                $modelSolicitudGenerica->id_SolicitudGenericaCuentaCon = 3;
            }else{
                //CONSTANCIA POSECIÖN EJIDAL
                $modelSolicitudGenericaCuentaConAvailables = SolicitudGenericaCuentacon::findAll(["isActivo"=>"1"]);
            }

            if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == 3 ){
                $modelSolicitudGenerica->scenario = SolicitudGenerica::SCENARIO_CREATE_EJIDAL;
            }

            




            /* IF MOTIVO = REGISTRO -> CUENTA CON EJIDAL */
            $modelContacto->load($this->request->post(),"Contacto");
            
            $personaSolicita->load($this->request->post("Persona"),"personaF");
            $personaMoralSolicita->load($this->request->post(/* "PersonaMoral" */),"PersonaMoral");


            $domicilioNotif->load($this->request->post("Domicilio2"),"0"); //Domicilio2 tambien funciona xd
            $domicilioPredio->load($this->request->post("Domicilio2"),"1");
            
            $modelEscritura->load($this->request->post(),"Escritura");
            $modelConstanciaEscritura->load($this->request->post(),"ConstanciaEscritura");
            $modelConstanciaPosecionEjidal->load($this->request->post(),"ConstanciaPosecionEjidal");

            $noPropietario =$this->request->post("noPropietarios");
            $modelPropietarios[1]->load($this->request->post("Persona"),"propietario1");
            
            if(is_numeric($noPropietario) && $noPropietario > 1){
                for ($i=2; $i <=$noPropietario ; $i++) {  //index 1 ya fue asignado afuera 
                    $modelPropietarios[$i] = new Persona();
                    $modelPropietarios[$i]->load($this->request->post("Persona"),"propietario$i");
                }
            }
            
            // extraer vars para archivos
            $modelTramiteMotivoCuentaConDoc = ConfigTramiteMotivoCuentaconDoc::findAll(
                [
                    "id_TipoTramite"=>1,//TipoTramite::findOne(["nombre"=>"CONTRUCCION"]) //trámite construcción
                    "id_MotivoConstruccion"=>$modelSolicitudGenerica->id_MotivoConstruccion,
                    "id_SolicitudGenericaCuentaCon"=>$modelSolicitudGenerica->id_SolicitudGenericaCuentaCon,
                    //"doc"=>1,            
                ]
            );
            foreach ($modelTramiteMotivoCuentaConDoc as $key => $curr) {
                if(!$curr->documento->isSoloEntregaFisica){
                    
                    $modelFilesRef_TramiteMotivoCuentaConDoc[$curr->id_Documento] =  new UploadFileVic(); 
                    $modelFilesRef_TramiteMotivoCuentaConDoc[$curr->id_Documento]->myFile 
                      = UploadedFile::getInstance(
                        $modelFilesRef_TramiteMotivoCuentaConDoc[$curr->id_Documento],
                      "[$curr->id_Documento]myFile"
                    );

                }
            }
           

            $memoriaCalculoFile->myFile = UploadedFile::getInstance($memoriaCalculoFile,'[memoriaCalculo]myFile');
            /* if($memoriaCalculoFile->myFile){
                
                $memoriaCalculoFile->myFile->saveAs(
                    "C:\\sduma_files\\".$memoriaCalculoFile->myFile->baseName . 
                    "." .$mem
                    +oriaCalculoFile->myFile->extension
                    ,false);
            } */
            $mecanicaSuelosFile->myFile = UploadedFile::getInstance($mecanicaSuelosFile,'[mecanicaSuelos]myFile');
            /* if($mecanicaSuelosFile->myFile){
                
                $mecanicaSuelosFile->myFile->saveAs(
                    "C:\\sduma_files\\".$mecanicaSuelosFile->myFile->baseName . 
                    "." . $mecanicaSuelosFile->myFile->extension
                    ,false);
            } */

            $licenciaConstruccionAreaPreexistenteFile->myFile = UploadedFile::getInstance($licenciaConstruccionAreaPreexistenteFile,'["licenciaConstruccionAreaPreexistente"]myFile');
            /* if($licenciaConstruccionAreaPreexistenteFile->myFile){
                
                $licenciaConstruccionAreaPreexistenteFile->myFile->saveAs(
                    "C:\\sduma_files\\".$licenciaConstruccionAreaPreexistenteFile->myFile->baseName . 
                    "." . $licenciaConstruccionAreaPreexistenteFile->myFile->extension
                    ,false);
            } */
            
            //////////////Fin de las cargas de datos a modelo, 

            //si es empty, significa que el estado del formulario cambió
            //si es "submit", significa que se dió click en enviar, ahi se ejecutará la validación. 
            $stateRequestVic = $this->request->post("stateRequestVic");
            if($stateRequestVic == "submit"){
                //Se corren todas las validaciones, si todo está okay, entonces, se procede al guardado de información

                //Las validaciones dependerán del workflow del formulario
                $resultValidation = $modelSolicitudGenerica->validate();
                //otras validaciones son dependientes de esta, asi que si esta falla, sale inemdiatamente

                if($resultValidation){

                    if($modelSolicitudGenerica->isSolicitaPersonaFisica=="1")
                        $resultValidation = $resultValidation && $personaSolicita->validate();                
                    else 
                        $resultValidation = $resultValidation && $personaMoralSolicita->validate();

                    $resultValidation = $resultValidation &&$modelContacto->validate();
                    $resultValidation = $resultValidation &&$domicilioNotif->validate();

                    if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "1")
                        $resultValidation = $resultValidation && $modelEscritura->validate();
                    else if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "2")
                        $resultValidation = $resultValidation &&  $modelConstanciaEscritura->validate();
                    else if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "3")
                        $resultValidation = $resultValidation &&  $modelConstanciaPosecionEjidal->validate();
                    else{
                        $resultValidation = $resultValidation && false;
                    }

                    //iTERA LA CONFIG DE ARCHIVOS (ARCHIVO AVAILABLES) PARA SACAR EL INDEX DE LOS ARCHIVOS EN $_POST
                    foreach ($modelTramiteMotivoCuentaConDoc as $key => $curr) {
                        if(!$curr->documento->isSoloEntregaFisica){
                            
                            $resultValidation = $resultValidation &&  $modelFilesRef_TramiteMotivoCuentaConDoc[$curr->id_Documento]->validate(); 
                        
                        }
                    }

                    foreach ($modelPropietarios as $key => $currPropietario) {
                        $resultValidation = $resultValidation && $currPropietario->validate();
                    }

                    //Solo cuando Superficie por construi > 250
                    if($modelSolicitudGenerica->superficiePorConstruir>=250)
                        $resultValidation = $resultValidation &&  $memoriaCalculoFile->validate();
                    //solo cuando niveles > 3
                    if($modelSolicitudGenerica->niveles>=3)
                        $resultValidation = $resultValidation && $mecanicaSuelosFile->validate();
                    
                    $resultValidation = $resultValidation && $domicilioPredio->validate(); 
                    //Opcional, no requiere validación
                    //$licenciaConstruccionAreaPreexistenteFile->validate();
                    if($resultValidation)//empieza a guardar archivos y data en DB.
                    {
                        $this->guardarSolicitud(
                            $modelSolicitudGenerica,
                            $modelContacto,
                            $personaSolicita,
                            $personaMoralSolicita,
                            $domicilioNotif,
                            $domicilioPredio,
                            $modelEscritura,
                            $modelConstanciaEscritura,
                            $modelConstanciaPosecionEjidal,
                            $noPropietario,
                            $modelPropietarios,
                            $modelFilesRef_TramiteMotivoCuentaConDoc,
                            $memoriaCalculoFile,
                            $mecanicaSuelosFile,
                            $licenciaConstruccionAreaPreexistenteFile,
                            $modelTramiteMotivoCuentaConDoc

                        );
                        return $this->redirect(['solicitud-generica/index']); 
                    }
                }    

                

            }

        }


        return $this->render('segunda', [
             
            'domicilioNotif' => $domicilioNotif ,
            'domicilioPredio' => $domicilioPredio ,
            'personaSolicita' => $personaSolicita ,
            'personaMoralSolicita' => $personaMoralSolicita ,
            //'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
            'modelEscritura' => $modelEscritura,
            'modelConstanciaEscritura' => $modelConstanciaEscritura,
            'modelConstanciaPosecionEjidal' => $modelConstanciaPosecionEjidal,            
            'modelSolicitudGenerica' => $modelSolicitudGenerica,
            'modelSolicitudGenericaCuentaConAvailables' => $modelSolicitudGenericaCuentaConAvailables,
            'modelTramiteMotivoCuentaConDoc'=> $modelTramiteMotivoCuentaConDoc,
            'modelFilesRef_TramiteMotivoCuentaConDoc'=> $modelFilesRef_TramiteMotivoCuentaConDoc,
            'memoriaCalculoFile' =>$memoriaCalculoFile,
            'licenciaConstruccionAreaPreexistenteFile' =>$licenciaConstruccionAreaPreexistenteFile,
            'mecanicaSuelosFile' => $mecanicaSuelosFile,
            'modelPropietarios' => $modelPropietarios,
            'modelContacto' => $modelContacto,
            'modelDROList' => $modelDROList
        ]);
         

    }

    public function guardarSolicitud(
        $modelSolicitudGenerica,
        $modelContacto,
        $personaSolicita,
        $personaMoralSolicita,
        $domicilioNotif,
        $domicilioPredio,
        $modelEscritura,
        $modelConstanciaEscritura,
        $modelConstanciaPosecionEjidal,
        $noPropietario,
        $modelPropietarios,
        //$modelTramiteMotivoCuentaConDoc,
        $modelFilesRef_TramiteMotivoCuentaConDoc,
        $memoriaCalculoFile,
        $mecanicaSuelosFile,
        $licenciaConstruccionAreaPreexistenteFile,
        $modelTramiteMotivoCuentaConDoc /* common/models/ConfigTramiteMotivoCuentaconDoc */
    ){
        $transaction = Yii::$app->db->beginTransaction();

        try {
            
            if($modelSolicitudGenerica-> isSolicitaPersonaFisica == "1"){
                $personaSolicita->save();
                $modelSolicitudGenerica->id_PersonaFisica = $personaSolicita->id;
            }else{                
                $personaMoralSolicita->save();
                $modelSolicitudGenerica->id_PersonaMoral = $personaMoralSolicita->id;                
            }

            $modelContacto->save();
            $modelSolicitudGenerica->id_Contacto = $modelContacto->id;

            $domicilioNotif->save();
            $modelSolicitudGenerica->id_DomicilioNotificaciones = $domicilioNotif->id;

            if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "1"){
                $modelEscritura->save();
                $modelSolicitudGenerica->id_Escritura = $modelEscritura->id;
            }
            else if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "2"){
                $modelConstanciaEscritura->save();
                $modelSolicitudGenerica->id_ConstanciaEscritura = $modelConstanciaEscritura->id;
            }
            else if($modelSolicitudGenerica->id_SolicitudGenericaCuentaCon == "3"){
                $modelConstanciaPosecionEjidal->save();
                $modelSolicitudGenerica->id_ConstanciaPosecionEjidal = $modelConstanciaPosecionEjidal->id;

            }
            foreach ($modelPropietarios as $key => $currPropietario) {
                $currPropietario->save();                
            }
            

            $domicilioPredio->save();
            $modelSolicitudGenerica->id_DomicilioPredio = $domicilioPredio->id;

            $modelSolicitudGenerica->fechaCreacion = date('Y-m-d h:m:s');
            $modelSolicitudGenerica->fechaModificacion = date('Y-m-d h:m:s');
            $modelSolicitudGenerica->id_User_CreadoPor = Yii::$app->user->identity->id;
            $modelSolicitudGenerica->id_User_ModificadoPor = Yii::$app->user->identity->id;

            $modelSolicitudGenerica->save();
            //cuando la solicitud se guarde, se puden guardar los propietarios.
            foreach ($modelPropietarios as $key => $currPropietario) {
                $currPropietarioRelation = new SolicitudGenerica_has_Persona();
                $currPropietarioRelation->id_Persona = $currPropietario->id;
                $currPropietarioRelation->id_SolicitudGenerica = $modelSolicitudGenerica->id;
                $currPropietarioRelation->save();
            }
            //directorio con el id del usuario
            $pathFile = "C:\\sduma_files\\".Yii::$app->user->identity->id."\\".$modelSolicitudGenerica->id."\\" ;
            if(!is_dir($pathFile) ){                
                mkdir($pathFile,0,true);
            }
            
            //Solo cuando Superficie por construi > 250
            if($modelSolicitudGenerica->superficiePorConstruir>250){                 

                //Registro a database
                $modelArchivo = new Archivo();
                $modelArchivo->realNombreArchivo = "memoriaCalculoFile" . "." . $memoriaCalculoFile->myFile->extension;
                $modelArchivo->nombreArchivo =
                    $memoriaCalculoFile->myFile->baseName . "." .
                        $memoriaCalculoFile->myFile->extension ;
                $modelArchivo->path = $pathFile ;


                $memoriaCalculoFile->myFile->saveAs($modelArchivo->path. $modelArchivo->realNombreArchivo );
                $modelArchivo->save();
                //añadir este modelArchivo ID al modelo de la solicitud
                $modelSolicitudGenerica-> id_Archivo_MemoriaCalculo = $modelArchivo->id;
                $modelSolicitudGenerica->update();
            }
            //solo cuando niveles >= 3
            if($modelSolicitudGenerica->niveles>=3){

                $modelArchivo = new Archivo();
                $modelArchivo->realNombreArchivo = "mecanicaSuelosFile" . "." . $mecanicaSuelosFile->myFile->extension;
                $modelArchivo->nombreArchivo =
                    $mecanicaSuelosFile->myFile->baseName . "." .
                        $mecanicaSuelosFile->myFile->extension ;
                $modelArchivo->path = $pathFile ;

                $mecanicaSuelosFile->myFile->saveAs($modelArchivo->path. $modelArchivo->realNombreArchivo );
                $modelArchivo->save();
                //añadir este modelArchivo ID al modelo de la solicitud
                $modelSolicitudGenerica-> id_Archivo_MecanicaSuelos = $modelArchivo->id;
                $modelSolicitudGenerica->update();
            }
            if($licenciaConstruccionAreaPreexistenteFile->myFile)
            {
                $modelArchivo = new Archivo();
                $modelArchivo->realNombreArchivo = "licenciaConstruccionAreaPreexistente" . "." . $licenciaConstruccionAreaPreexistenteFile->myFile->extension;
                $modelArchivo->nombreArchivo =
                    $licenciaConstruccionAreaPreexistenteFile->myFile->baseName . "." .
                        $licenciaConstruccionAreaPreexistenteFile->myFile->extension ;
                $modelArchivo->path = $pathFile ;
                
                $licenciaConstruccionAreaPreexistenteFile->myFile->saveAs($modelArchivo->path. $modelArchivo->realNombreArchivo );
                $modelArchivo->save();
                //añadir este modelArchivo ID al modelo de la solicitud
                $modelSolicitudGenerica->id_Archivo_LicenciaConstruccionAreaPreexistenteFile = $modelArchivo->id;
                $modelSolicitudGenerica->update();
            }
            //Archivos registrados en DB
            //UploadedFileVic array           
            foreach ( $modelTramiteMotivoCuentaConDoc as $currFileAvailable ) {

                $modelArchivo = new Archivo();
                //$modelArchivo = Archivo::findOne(["id"=>"1"]) ;//no referencia a archivo
                $resultSaveFile = false;

                $currSolicitudGeericaHasDoc = new SolicitudGenerica_has_Documento();
                $currSolicitudGeericaHasDoc->id_SolicitudGenerica = $modelSolicitudGenerica->id;
                $currSolicitudGeericaHasDoc->id_Documento = $currFileAvailable->id_Documento;

                if( $currFileAvailable->documento->isSoloEntregaFisica == "0"){

                    $currFileToWrite = $modelFilesRef_TramiteMotivoCuentaConDoc[$currFileAvailable->id_Documento] ;

                    $modelArchivo->realNombreArchivo = 
                        $currFileAvailable->id_Documento . "." . $currFileToWrite->myFile->extension;
                    
                    $modelArchivo->nombreArchivo =
                        $currFileToWrite->myFile->baseName . "." .
                         $currFileToWrite->myFile->extension ;
                         $modelArchivo->path = $pathFile ;
                         
                    $resultSaveFile =  $currFileToWrite->myFile->saveAs($modelArchivo->path. $modelArchivo->realNombreArchivo ); //ESCRIBE ARCHIVO
                    $modelArchivo->save(); //GUARDA EN DB

                    $currSolicitudGeericaHasDoc->isEntregado = 1;
                    $currSolicitudGeericaHasDoc->id_Archivo = $modelArchivo->id;
                    /* $currSolicitudGeericaHasDoc->save(); */
                    
                }else{
                    //cuando 
                    $resultSaveFile = true;
                    $currSolicitudGeericaHasDoc->isEntregado = 0;
                    $currSolicitudGeericaHasDoc->id_Archivo = 1; //archivo no existente (no se sube al sistema)

                }

                $currSolicitudGeericaHasDoc->save();

            }                                
            // ...other DB operations...
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    private function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    private function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() 
        ) {

            
            $resSignup = $model->signup();
            
            /* error,danger,success,info,warning */
            if($resSignup["success"]){

                Yii::$app->session->setFlash('success', 
                "Gracias por su registro. Email de verificación fue enviada a su correo $model->email.");
                return $this->goHome();
            }else{
                    Yii::$app->session->setFlash('danger', 
                    $resSignup["MSG"]
                );
               
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);

    }


    public function actionProbarActiveR(){
        ProbarActive::insertarAlv();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Su email ha sido verificado!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'No fue posible verificar su cuenta con el link usado.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


    public function actionPersona()
    {
        $model = new \common\models\persona();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('persona', [
            'model' => $model,
        ]);
    }
}
