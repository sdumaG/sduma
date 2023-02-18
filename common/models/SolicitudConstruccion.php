<?php

namespace common\models;
use Exception;
use PDO;
use PDOException;
use Yii;

/**
 * This is the model class for table "SolicitudConstruccion".
 *
 * @property int $id
 * @property int|null $superficieTotal
 * @property int|null $superficiePorConstruir
 * @property int|null $superficiePreexistente
 * @property int|null $niveles
 * @property int|null $cajones
 * @property string|null $COS
 * @property string|null $CUS
 * @property string|null $RPP
 * @property string|null $tomo
 * @property string|null $folioElec
 * @property string|null $cuentaCatastral
 * @property string $fechaCreacion
 * @property string $fechaModificacion
 * @property int $isDeleted
 * @property int $id_User_CreadoPor
 * @property int $id_User_ModificadoPor
 * @property int $id_DomicilioNotificaciones
 * @property int $id_DomicilioPredio
 * @property int $id_MotivoConstruccion
 * @property int|null $id_Contacto
 * @property int|null $id_TipoPredio
 * @property int $id_TipoConstruccion
 * @property int $id_GeneroConstruccion
 * @property int|null $id_SubGeneroConstruccion
 * @property int|null $id_DirectorResponsableObra
 * @property int|null $id_CorrSeguridadEstruc
 * @property int $id_Expediente
 *
 * @property Contacto $contacto
 * @property CorrSeguridadEstruc $corrSeguridadEstruc
 * @property DirectorResponsableObra $directorResponsableObra
 * @property Documento[] $documentos
 * @property Domicilio $domicilioNotificaciones
 * @property Domicilio $domicilioPredio
 * @property Expediente $expediente
 * @property GeneroConstruccion $generoConstruccion
 * @property MotivoConstruccion $motivoConstruccion
 * @property Persona[] $personas
 * @property SolicitudConstruccionHasDocumento[] $solicitudConstruccionHasDocumentos
 * @property SolicitudConstruccionHasPersona[] $solicitudConstruccionHasPersonas
 * @property SubGeneroConstruccion $subGeneroConstruccion
 * @property TipoConstruccion $tipoConstruccion
 * @property TipoPredio $tipoPredio
 * @property User $userCreadoPor
 * @property User $userModificadoPor
 */
class SolicitudConstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudConstruccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_Persona_CreadoPor', 'id_Persona_ModificadoPor', 'id_Persona_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],
            [['superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'id_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],

            //[['fechaCreacion', 'fechaModificacion', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'id_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_Expediente'], 'required'],
            [['superficieTotal', 'superficiePorConstruir', 'superficiePreexistente', 'niveles', 'cajones', 'isDeleted', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'id_DomicilioNotificaciones', 'id_DomicilioPredio', 'id_MotivoConstruccion', 'id_Contacto', 'id_TipoPredio', 'id_TipoConstruccion', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DirectorResponsableObra', 'id_CorrSeguridadEstruc', 'id_Expediente'], 'integer'],

            [['fechaCreacion', 'fechaModificacion'], 'safe'],
            [['COS', 'CUS', 'RPP', 'tomo', 'folioElec', 'cuentaCatastral'], 'string', 'max' => 45],

            [['id_User_CreadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_CreadoPor' => 'id']],
            [['id_User_ModificadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_ModificadoPor' => 'id']],

            [['id_MotivoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoConstruccion::class, 'targetAttribute' => ['id_MotivoConstruccion' => 'id']],
            [['id_DomicilioNotificaciones'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_DomicilioNotificaciones' => 'id']],
            [['id_DomicilioPredio'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio::class, 'targetAttribute' => ['id_DomicilioPredio' => 'id']],
            [['id_TipoPredio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPredio::class, 'targetAttribute' => ['id_TipoPredio' => 'id']],
            [['id_Contacto'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::class, 'targetAttribute' => ['id_Contacto' => 'Id']],
            [['id_GeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => GeneroConstruccion::class, 'targetAttribute' => ['id_GeneroConstruccion' => 'id']],
           // ['id_GeneroConstruccion', 'compare', 'compareValue' => 1, 'operator' => '>='],

            [['id_SubGeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => SubGeneroConstruccion::class, 'targetAttribute' => ['id_SubGeneroConstruccion' => 'id']],
/*             ['id_GeneroConstruccion', 'compare', 'compareValue' => 1, 'operator' => '>='],
 */
            [['id_TipoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => TipoConstruccion::class, 'targetAttribute' => ['id_TipoConstruccion' => 'id']],
            [['id_CorrSeguridadEstruc'], 'exist', 'skipOnError' => true, 'targetClass' => CorrSeguridadEstruc::class, 'targetAttribute' => ['id_CorrSeguridadEstruc' => 'id']],
            [['id_DirectorResponsableObra'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_DirectorResponsableObra' => 'id']],
            [['id_Expediente'], 'exist', 'skipOnError' => true, 'targetClass' => Expediente::class, 'targetAttribute' => ['id_Expediente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'superficieTotal' => 'Superficie Total',
            'superficiePorConstruir' => 'Superficie Por Construir',
            'superficiePreexistente' => 'Superficie Preexistente',
            'niveles' => 'Niveles',
            'cajones' => 'Cajones',
            'COS' => 'COS',
            'CUS' => 'CUS',
            'RPP' => 'RPP',
            'tomo' => 'Tomo',
            'folioElec' => 'Folio Electrónico',
            'cuentaCatastral' => 'Cuenta Catastral',
            'fechaCreacion' => 'Fecha Creación',
            'fechaModificacion' => 'Fecha Modificación',
            'isDeleted' => 'Is Deleted',
            'id_User_CreadoPor' => 'Creado Por',
            'id_User_ModificadoPor' => 'Modificado Por',
            'id_DomicilioNotificaciones' => 'Id Persona Domicilio Notificaciones',
            'id_DomicilioPredio' => 'Id Domicilio Predio',
            'id_MotivoConstruccion' => 'Id Motivo Construccion',
            'id_Contacto' => 'Id Contacto',
            'id_TipoPredio' => 'Id Tipo Predio',
            'id_TipoConstruccion' => 'Id Tipo Construccion',
            'id_GeneroConstruccion' => 'Id Genero Construccion',
            'id_SubGeneroConstruccion' => 'Id Sub Genero Construccion',
            'id_DirectorResponsableObra' => 'Id Director Responsable Obra',
            'id_CorrSeguridadEstruc' => 'Id Corr Seguridad Estruc',
            'id_Expediente' => 'Id Expediente',
        ];
    }

    /* 
    PDO TYPES 
      'boolean' => \PDO::PARAM_BOOL,
            'integer' => \PDO::PARAM_INT,
            'string' => \PDO::PARAM_STR,
            'resource' => \PDO::PARAM_LOB,
            'NULL' => \PDO::PARAM_NULL,
        ];
    
    */
    public function formatSoliHasDocParam($docs){
        $docsParam = [];

        foreach ($docs as $key => $value) {
            
            $docsParam[] = array(
                $value->id_Documento,
                $value->isEntregado == null?0:$value->isEntregado,
                $value->nombreArchivo,
                $value->path,
                $value->realNombreArchivo,
            );

        }
        ob_start();
        var_dump($docsParam);
        Yii::debug(ob_get_clean(),__METHOD__);
        return $docsParam;
        
    }

    public function updateSolicitudExpediente($propietarioPersona, $soliDomicilioNotif, $soliDomicilioPredio,  $soliContacto,  $soliHasDocuments,$currentUserId ){
        //solo modificar, si el SP cambió, no recibe los mismos params que el SP de crear. : )
        $sql = "sp_update_soliconstruccion ".
        ":propietarioNombre,:propietarioApellidoP,:propietarioApellidoM,:email,:telefono".
        ",:notificacionesColoniaFraccBarrio,:notificacionesCalle,:notificacionesNumExt,:notificacionesNumInt,:notificacionesCP,:notificacionesEntreCalleV,:notificacionesEntreCalleH".
        ",:idMotivoConstruccion,:idTipoPredio".
        ",:superficieTotal,:superficiePorConstruir".
        ",:predioColoniaFraccBarrio,:predioCalle,:predioNumExt,:predioNumInt,:predioCP,:predioEntreCalleV,:predioEntreCalleH".
        ",:idGeneroConstruccion,:idSubGeneroConstruccion,:idTipoConstruccion".
        ",:niveles,:cajones,:cos,:cus,:superficiePreexistente,:rpp,:tomo".
        ",:folioElec,:cuentaCatastral".
        ",:idDirectorResponsableObra,:idCorrSeguridadEstruc,:idUserModificadoPor,:idExpediente"./* ,:idSolicitudConstrucEdit */ 
        ",:documentos ;";
        $docsAsParams = $this ->formatSoliHasDocParam($soliHasDocuments);
        $ddd = array("SoliHasDocParam" =>  $docsAsParams);
        $res = -1;
        try{
                $connection = Yii::$app -> db -> pdo;
                $statement = $connection -> prepare($sql);                
                /* Propietario */
                $statement-> bindValue(":propietarioNombre",$propietarioPersona ->nombre,PDO::PARAM_STR);
                $statement-> bindValue(":propietarioApellidoP",$propietarioPersona ->apellidoP,PDO::PARAM_STR);
                $statement-> bindValue(":propietarioApellidoM",$propietarioPersona ->apellidoM,PDO::PARAM_STR);
                
                $statement/* Contacto */;
                $statement-> bindValue(":email",$soliContacto ->email,PDO::PARAM_STR);
                $statement-> bindValue(":telefono",$soliContacto ->telefono,PDO::PARAM_STR);

                $statement/* Notificaciones Domicilio */;
                $statement-> bindValue(":notificacionesColoniaFraccBarrio",$soliDomicilioNotif ->coloniaFraccBarrio,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesCalle",$soliDomicilioNotif ->calle,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesNumExt",$soliDomicilioNotif ->numExt,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesNumInt",$soliDomicilioNotif ->numInt,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesCP",$soliDomicilioNotif ->cp,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesEntreCalleV",$soliDomicilioNotif ->entreCallesV,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesEntreCalleH",$soliDomicilioNotif ->entreCallesH,PDO::PARAM_STR);
             
                $statement-> bindValue(":idMotivoConstruccion",$this->id_MotivoConstruccion ,PDO::PARAM_INT);
                $statement-> bindValue(":idTipoPredio",$this->id_TipoPredio,PDO::PARAM_INT);
                $statement-> bindValue(":superficieTotal",$this->superficieTotal ,PDO::PARAM_INT);
                $statement-> bindValue(":superficiePorConstruir",$this->superficiePorConstruir,PDO::PARAM_INT);
 
                $statement/* pREDIO Domicilio */;
                $statement-> bindValue(":predioColoniaFraccBarrio",$soliDomicilioPredio ->coloniaFraccBarrio,PDO::PARAM_STR);
                $statement-> bindValue(":predioCalle",$soliDomicilioPredio ->calle,PDO::PARAM_STR);
                $statement-> bindValue(":predioNumExt",$soliDomicilioPredio ->numExt,PDO::PARAM_STR);
                $statement-> bindValue(":predioNumInt",$soliDomicilioPredio ->numInt,PDO::PARAM_STR);
                $statement-> bindValue(":predioCP",$soliDomicilioPredio ->cp,PDO::PARAM_STR);
                $statement-> bindValue(":predioEntreCalleV",$soliDomicilioPredio ->entreCallesV,PDO::PARAM_STR);
                $statement-> bindValue(":predioEntreCalleH",$soliDomicilioPredio ->entreCallesH,PDO::PARAM_STR);
             
                $statement-> bindValue(":idGeneroConstruccion",$this ->id_GeneroConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":idSubGeneroConstruccion",$this ->id_SubGeneroConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":idTipoConstruccion",$this ->id_TipoConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":niveles",$this ->niveles,PDO::PARAM_STR);
                $statement-> bindValue(":cajones",$this ->cajones,PDO::PARAM_STR);
                $statement-> bindValue(":cos",$this ->COS,PDO::PARAM_STR);
                $statement-> bindValue(":cus",$this ->CUS,PDO::PARAM_STR);
                $statement-> bindValue(":superficiePreexistente",$this ->superficiePreexistente,PDO::PARAM_STR);
                $statement-> bindValue(":rpp",$this ->RPP,PDO::PARAM_STR);
                $statement-> bindValue(":tomo",$this ->tomo,PDO::PARAM_STR);
                $statement-> bindValue(":folioElec",$this ->folioElec,PDO::PARAM_STR);
                $statement-> bindValue(":cuentaCatastral",$this ->cuentaCatastral,PDO::PARAM_STR);
                $statement-> bindValue(":idDirectorResponsableObra",$this ->id_DirectorResponsableObra,PDO::PARAM_INT);
                $statement-> bindValue(":idCorrSeguridadEstruc",$this ->id_CorrSeguridadEstruc,PDO::PARAM_INT);
                       
                $statement-> bindValue(":idUserModificadoPor",$currentUserId ,PDO::PARAM_INT);//cambió
                $statement-> bindValue(":idExpediente",$this ->id_Expediente,PDO::PARAM_INT);
                $statement-> bindParam(":documentos",$ddd ,PDO::PARAM_LOB);
                $executed = $statement->execute();
                if(!$executed) return ["success" => false, "MSG" => "Error inesperado, no hubo cambios.".(65413)];//random error code xd
                $res = $statement-> fetchColumn(0);//ROWS_INSERTED column
                
                /* $res = $rows[0]["ROWS_INSERTED"] ; */
           
        }
        catch (PDOException $ex) {
            Yii::debug($ex, $category = __METHOD__);
            return ["success" => false, "MSG" => $ex->getMessage().""];
        }
        catch( Exception $ex){
            Yii::debug($ex, $category = __METHOD__);
            return ["success" => false, "MSG" => $ex->getMessage().""];
        }
        Yii::debug($res, $category = __METHOD__);
        return ["success" => true,"MSG" => "Solicitud Actualicada creado."."NO EXCEPTION"]; 

    }

    public function createSolicitudExpediente($propietarioPersona, $soliDomicilioNotif, $soliDomicilioPredio,  $soliContacto,  $soliHasDocuments,$currentUserId ){
        $sql ="EXEC sp_create_soliconstruccion ".
        ":propietarioNombre,:propietarioApellidoP,:propietarioApellidoM,:email,:telefono,".
        ":notificacionesColoniaFraccBarrio,:notificacionesCalle,:notificacionesNumExt,:notificacionesNumInt,:notificacionesCP,".
        ":notificacionesEntreCalleV,:notificacionesEntreCalleH,:idMotivoConstruccion,:idTipoPredio,:superficieTotal,:superficiePorConstruir,".
        ":predioColoniaFraccBarrio,:predioCalle,:predioNumExt,:predioNumInt,:predioCP,:predioEntreCalleV,:predioEntreCalleH,:idGeneroConstruccion,".
        ":idSubGeneroConstruccion,:idTipoConstruccion,:niveles,:cajones,:cos,:cus,:superficiePreexistente,:rpp,:tomo,:folioElec,:cuentaCatastral,".
        ":idDirectorResponsableObra,:idCorrSeguridadEstruc,:idUserCreadoPor,:idExpediente,:documentos ; ";
        $docsAsParams = $this ->formatSoliHasDocParam($soliHasDocuments);
        $ddd = array("SoliHasDocParam" =>  $docsAsParams);
        $res = -1;
        try{
            /* $rows =  Yii::$app->db->createCommand($sql, $params) ->queryAll( ); */
                $connection = Yii::$app -> db -> pdo;
                $statement = $connection -> prepare($sql);                
                /* Propietario */
                $statement-> bindValue(":propietarioNombre",$propietarioPersona ->nombre,PDO::PARAM_STR);
                $statement-> bindValue(":propietarioApellidoP",$propietarioPersona ->apellidoP,PDO::PARAM_STR);
                $statement-> bindValue(":propietarioApellidoM",$propietarioPersona ->apellidoM,PDO::PARAM_STR);
                
                $statement/* Contacto */;
                $statement-> bindValue(":email",$soliContacto ->email,PDO::PARAM_STR);
                $statement-> bindValue(":telefono",$soliContacto ->telefono,PDO::PARAM_STR);

                $statement/* Notificaciones Domicilio */;
                $statement-> bindValue(":notificacionesColoniaFraccBarrio",$soliDomicilioNotif ->coloniaFraccBarrio,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesCalle",$soliDomicilioNotif ->calle,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesNumExt",$soliDomicilioNotif ->numExt,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesNumInt",$soliDomicilioNotif ->numInt,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesCP",$soliDomicilioNotif ->cp,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesEntreCalleV",$soliDomicilioNotif ->entreCallesV,PDO::PARAM_STR);
                $statement-> bindValue(":notificacionesEntreCalleH",$soliDomicilioNotif ->entreCallesH,PDO::PARAM_STR);
             
                $statement-> bindValue(":idMotivoConstruccion",$this->id_MotivoConstruccion ,PDO::PARAM_INT);
                $statement-> bindValue(":idTipoPredio",$this->id_TipoPredio,PDO::PARAM_INT);
                $statement-> bindValue(":superficieTotal",$this->superficieTotal ,PDO::PARAM_INT);
                $statement-> bindValue(":superficiePorConstruir",$this->superficiePorConstruir,PDO::PARAM_INT);
 
                $statement/* pREDIO Domicilio */;
                $statement-> bindValue(":predioColoniaFraccBarrio",$soliDomicilioPredio ->coloniaFraccBarrio,PDO::PARAM_STR);
                $statement-> bindValue(":predioCalle",$soliDomicilioPredio ->calle,PDO::PARAM_STR);
                $statement-> bindValue(":predioNumExt",$soliDomicilioPredio ->numExt,PDO::PARAM_STR);
                $statement-> bindValue(":predioNumInt",$soliDomicilioPredio ->numInt,PDO::PARAM_STR);
                $statement-> bindValue(":predioCP",$soliDomicilioPredio ->cp,PDO::PARAM_STR);
                $statement-> bindValue(":predioEntreCalleV",$soliDomicilioPredio ->entreCallesV,PDO::PARAM_STR);
                $statement-> bindValue(":predioEntreCalleH",$soliDomicilioPredio ->entreCallesH,PDO::PARAM_STR);
             
                $statement-> bindValue(":idGeneroConstruccion",$this ->id_GeneroConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":idSubGeneroConstruccion",$this ->id_SubGeneroConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":idTipoConstruccion",$this ->id_TipoConstruccion,PDO::PARAM_INT);
                $statement-> bindValue(":niveles",$this ->niveles,PDO::PARAM_STR);
                $statement-> bindValue(":cajones",$this ->cajones,PDO::PARAM_STR);
                $statement-> bindValue(":cos",$this ->COS,PDO::PARAM_STR);
                $statement-> bindValue(":cus",$this ->CUS,PDO::PARAM_STR);
                $statement-> bindValue(":superficiePreexistente",$this ->superficiePreexistente,PDO::PARAM_STR);
                $statement-> bindValue(":rpp",$this ->RPP,PDO::PARAM_STR);
                $statement-> bindValue(":tomo",$this ->tomo,PDO::PARAM_STR);
                $statement-> bindValue(":folioElec",$this ->folioElec,PDO::PARAM_STR);
                $statement-> bindValue(":cuentaCatastral",$this ->cuentaCatastral,PDO::PARAM_STR);
                $statement-> bindValue(":idDirectorResponsableObra",$this ->id_DirectorResponsableObra,PDO::PARAM_INT);
                $statement-> bindValue(":idCorrSeguridadEstruc",$this ->id_CorrSeguridadEstruc,PDO::PARAM_INT);
                       // -> bindValue(":idUserCreadoPor",$this ->id_SubGeneroConstruccion,PDO::PARAM_STR)
                $statement-> bindValue(":idUserCreadoPor",$currentUserId ,PDO::PARAM_INT);
                $statement-> bindValue(":idExpediente",$this ->id_Expediente,PDO::PARAM_INT);
                $statement-> bindParam(":documentos",$ddd ,PDO::PARAM_LOB);
                $statement->execute();
                $res = $statement-> fetchColumn(0);//ROWS_INSERTED column

          /*   $res = $rows[0]["ROWS_INSERTED"] ; */
           
        }
        catch (PDOException $ex) {
            Yii::info($ex, $category = 'PDO ERROR Execute command.');
            return ["success" => false,"MSG" =>"Error al crear solicitud."]; 

        }
        catch( Exception $ex){
            Yii::info($ex, $category = 'ERROR Execute command.');
            return ["success" => false, "MSG" => $ex->getMessage()."Exception creo"];
        }
        Yii::info($res, $category = 'DB ACTION');
        return ["success" => true,"MSG" => "Expediente creado."."NO EXCEPTION"]; 
        
 
    }

    
    /* 
    
    -> bindValue(":propietarioNombre",$propietarioPersona ->nombre,PDO::PARAM_STR)
                -> bindValue(":propietarioApellidoP",$propietarioPersona ->apellidoP,PDO::PARAM_STR)
                -> bindValue(":propietarioApellidoM",$propietarioPersona ->apellidoM,PDO::PARAM_STR)
                
                // Contacto  
                -> bindValue(":email",$soliContacto ->email,PDO::PARAM_STR)
                -> bindValue(":telefono",$soliContacto ->telefono,PDO::PARAM_STR)

                // Notificaciones Domicilio 
                -> bindValue(":notificacionesColoniaFraccBarrio",$soliDomicilioNotif ->coloniaFraccBarrio,PDO::PARAM_STR)
                -> bindValue(":notificacionesCalle",$soliDomicilioNotif ->calle,PDO::PARAM_STR)
                -> bindValue(":notificacionesNumExt",$soliDomicilioNotif ->numExt,PDO::PARAM_STR)
                -> bindValue(":notificacionesNumInt",$soliDomicilioNotif ->numInt,PDO::PARAM_STR)
                -> bindValue(":notificacionesCP",$soliDomicilioNotif ->calle,PDO::PARAM_STR)
                -> bindValue(":notificacionesEntreCalleV",$soliDomicilioNotif ->entreCallesV,PDO::PARAM_STR)
                -> bindValue(":notificacionesEntreCalleH",$soliDomicilioNotif ->entreCallesH,PDO::PARAM_STR)
             
             
                -> bindValue(":idMotivoConstruccion",$this->id_MotivoConstruccion ,PDO::PARAM_INT)
                -> bindValue(":idTipoPredio",$this->id_TipoPredio,PDO::PARAM_INT)
                -> bindValue(":superficieTotal",$this->superficieTotal ,PDO::PARAM_INT)
                -> bindValue(":superficiePorConstruir",$this->superficiePorConstruir,PDO::PARAM_INT)
 
                // pREDIO Domicilio 
                -> bindValue(":predioColoniaFraccBarrio",$soliDomicilioPredio ->coloniaFraccBarrio,PDO::PARAM_STR)
                -> bindValue(":predioCalle",$soliDomicilioPredio ->calle,PDO::PARAM_STR)
                -> bindValue(":predioNumExt",$soliDomicilioPredio ->numExt,PDO::PARAM_STR)
                -> bindValue(":predioNumInt",$soliDomicilioPredio ->numInt,PDO::PARAM_STR)
                -> bindValue(":predioCP",$soliDomicilioPredio ->calle,PDO::PARAM_STR)
                -> bindValue(":predioEntreCalleV",$soliDomicilioPredio ->entreCallesV,PDO::PARAM_STR)
                -> bindValue(":predioEntreCalleH",$soliDomicilioPredio ->entreCallesH,PDO::PARAM_STR)
                
                -> bindValue(":idGeneroConstruccion",$this ->id_GeneroConstruccion,PDO::PARAM_INT)
                -> bindValue(":idSubGeneroConstruccion",$this ->id_SubGeneroConstruccion,PDO::PARAM_INT)
                -> bindValue(":idTipoConstruccion",$this ->id_TipoConstruccion,PDO::PARAM_INT)
                -> bindValue(":niveles",$this ->niveles,PDO::PARAM_STR)
                -> bindValue(":cajones",$this ->cajones,PDO::PARAM_STR)
                -> bindValue(":cos",$this ->COS,PDO::PARAM_STR)
                -> bindValue(":cus",$this ->CUS,PDO::PARAM_STR)
                -> bindValue(":superficiePreexistente",$this ->superficiePreexistente,PDO::PARAM_STR)
                -> bindValue(":rpp",$this ->RPP,PDO::PARAM_STR)
                -> bindValue(":tomo",$this ->tomo,PDO::PARAM_STR)
                -> bindValue(":folioElec",$this ->folioElec,PDO::PARAM_STR)
                -> bindValue(":cuentaCatastral",$this ->cuentaCatastral,PDO::PARAM_STR)
                -> bindValue(":idDirectorResponsableObra",$this ->id_DirectorResponsableObra,PDO::PARAM_INT)
                -> bindValue(":idCorrSeguridadEstruc",$this ->id_CorrSeguridadEstruc,PDO::PARAM_INT)
               // -> bindValue(":idUserCreadoPor",$this ->id_SubGeneroConstruccion,PDO::PARAM_STR)
                -> bindValue(":idUserCreadoPor",$currentUserId ,PDO::PARAM_INT)
                -> bindValue(":idExpediente",$this ->id_Expediente,PDO::PARAM_INT)
                -> bindParam(":documentos", $arrdocsAsParams ,PDO::PARAM_LOB)
    


                  $par = [
                ":propietarioNombre"=>$propietarioPersona ->nombre,
                 ":propietarioApellidoP"=>$propietarioPersona ->apellidoP ,
                ":propietarioApellidoM"=>$propietarioPersona ->apellidoM, 
                                // Contacto 
                                ":email"=>$soliContacto ->email,
                                ":telefono"=>$soliContacto ->telefono,
                
                                 // Notificaciones Domicilio 
                                ":notificacionesColoniaFraccBarrio"=>$soliDomicilioNotif ->coloniaFraccBarrio,
                                ":notificacionesCalle"=>$soliDomicilioNotif ->calle,
                                ":notificacionesNumExt"=>$soliDomicilioNotif ->numExt,
                                ":notificacionesNumInt"=>$soliDomicilioNotif ->numInt,
                                ":notificacionesCP"=>$soliDomicilioNotif ->calle,
                                ":notificacionesEntreCalleV"=>$soliDomicilioNotif ->entreCallesV,
                                ":notificacionesEntreCalleH"=>$soliDomicilioNotif ->entreCallesH,
                             
                             
                                ":idMotivoConstruccion"=>$this->id_MotivoConstruccion ,
                                ":idTipoPredio"=>$this->id_TipoPredio,
                                ":superficieTotal"=>$this->superficieTotal ,
                                ":superficiePorConstruir"=>$this->superficiePorConstruir,
                 
                                  // pREDIO Domicilio
                                ":predioColoniaFraccBarrio"=>$soliDomicilioPredio ->coloniaFraccBarrio,
                                ":predioCalle"=>$soliDomicilioPredio ->calle,
                                ":predioNumExt"=>$soliDomicilioPredio ->numExt,
                                ":predioNumInt"=>$soliDomicilioPredio ->numInt,
                                ":predioCP"=>$soliDomicilioPredio ->calle,
                                ":predioEntreCalleV"=>$soliDomicilioPredio ->entreCallesV,
                                ":predioEntreCalleH"=>$soliDomicilioPredio ->entreCallesH,
                                            ":idGeneroConstruccion"=>$this ->id_GeneroConstruccion,
                                ":idSubGeneroConstruccion"=>$this ->id_SubGeneroConstruccion,
                                ":idTipoConstruccion"=>$this ->id_TipoConstruccion,
                                ":niveles"=>$this ->niveles,
                                ":cajones"=>$this ->cajones,
                                ":cos"=>$this ->COS,
                                ":cus"=>$this ->CUS,
                                ":superficiePreexistente"=>$this ->superficiePreexistente,
                                ":rpp"=>$this ->RPP,
                                ":tomo"=>$this ->tomo,
                                ":folioElec"=>$this ->folioElec,
                                ":cuentaCatastral"=>$this ->cuentaCatastral,
                                ":idDirectorResponsableObra"=>$this ->id_DirectorResponsableObra,
                                ":idCorrSeguridadEstruc"=>$this ->id_CorrSeguridadEstruc,
                                 // -> ":idUserCreadoPor"=>$this ->id_SubGeneroConstruccion,
                                ":idUserCreadoPor"=>$currentUserId ,
                                ":idExpediente"=>$this->id_Expediente,
                                ":documentos"=>array("SoliHasDocParam" =>  $docsAsParams)
                                    ];
                                $comm = Yii::$app -> db -> createCommand($sql,$par);
                                $comm ->execute( );
    */
    /**
     * Gets query for [[Contacto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacto()
    {
        return $this->hasOne(Contacto::class, ['id' => 'id_Contacto']);
    }

    /**
     * Gets query for [[CorrSeguridadEstruc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorrSeguridadEstruc()
    {
        return $this->hasOne(CorrSeguridadEstruc::class, ['id' => 'id_CorrSeguridadEstruc']);
    }

    /**
     * Gets query for [[DirectorResponsableObra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorResponsableObra()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_DirectorResponsableObra']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::class, ['id' => 'id_Documento'])->viaTable('SolicitudConstruccion_has_Documento', ['id_SolicitudConstruccion' => 'id']);
    }

    /**
     * Gets query for [[DomicilioNotificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioNotificaciones()
    {
        return $this->hasOne(Domicilio::class, ['id' => 'id_DomicilioNotificaciones']);
    }

    /**
     * Gets query for [[DomicilioPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioPredio()
    {
        return $this->hasOne(Domicilio::class, ['id' => 'id_DomicilioPredio']);
    }

    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(Expediente::class, ['id' => 'id_Expediente']);
    }

    /**
     * Gets query for [[GeneroConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGeneroConstruccion()
    {
        return $this->hasOne(GeneroConstruccion::class, ['id' => 'id_GeneroConstruccion']);
    }

    /**
     * Gets query for [[MotivoConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoConstruccion()
    {
        return $this->hasOne(MotivoConstruccion::class, ['id' => 'id_MotivoConstruccion']);
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::class, ['id' => 'Persona_id'])->viaTable('SolicitudConstruccion_has_Persona', ['SolicitudConstruccion_Id' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccionHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccionHasDocumentos()
    {
        return $this->hasMany(SolicitudConstruccionHasDocumento::class, ['id_SolicitudConstruccion' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccionHasPersonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccionHasPersonas()
    {
        return $this->hasMany(SolicitudConstruccionHasPersona::class, ['SolicitudConstruccion_Id' => 'id']);
    }

    /**
     * Gets query for [[SubGeneroConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubGeneroConstruccion()
    {
        return $this->hasOne(SubGeneroConstruccion::class, ['id' => 'id_SubGeneroConstruccion']);
    }

    /**
     * Gets query for [[TipoConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoConstruccion()
    {
        return $this->hasOne(TipoConstruccion::class, ['id' => 'id_TipoConstruccion']);
    }

    /**
     * Gets query for [[TipoPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPredio()
    {
        return $this->hasOne(TipoPredio::class, ['id' => 'id_TipoPredio']);
    }

    /**
     * Gets query for [[UserCreadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_User_CreadoPor']);
    }

    /**
     * Gets query for [[UserModificadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserModificadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'id_User_ModificadoPor']);
    }
}
