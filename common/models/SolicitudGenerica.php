<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "SolicitudGenerica".
 *
 * @property int $id
 * @property int $statusSolicitud
 * @property int $isSolicitaPersonaFisica
 * @property int $superficieTotal
 * @property int $niveles
 * @property float|null $superficiePorConstruir
 * @property float|null $areaPreExistente
 * @property string|null $tipoTomaAgua
 * @property int $numeroTomaAgua
 * @property string $fechaPagoAguaOContrato
 * @property int|null $numeroReciboAgua
 * @property int $subeRecibo
 * @property int|null $numeroPredial
 * @property string|null $fechaPagoPredial
 * @property float|null $altura
 * @property float|null $metrosLineales
 * @property int|null $id_MetrosLinealesDRO
 * @property int|null $id_AlturaDRO
 * @property int|null $id_PersonaFisica
 * @property int|null $id_PersonaMoral
 * @property int $id_Contacto
 * @property int $id_DomicilioNotificaciones
 * @property int $id_MotivoConstruccion
 * @property int $id_SolicitudGenericaCuentaCon
 * @property int|null $id_Escritura
 * @property int|null $id_ConstanciaEscritura
 * @property int|null $id_ConstanciaPosecionEjidal
 * @property int $id_TipoPredio
 * @property int $id_GeneroConstruccion
 * @property int|null $id_SubGeneroConstruccion
 * @property int $id_DomicilioPredio
 * @property int $id_DirectorResponsableObra
 * @property int|null $id_Archivo_MemoriaCalculo
 * @property int|null $id_Archivo_MecanicaSuelos
 * @property int|null $id_Archivo_LicenciaConstruccionAreaPreexistenteFile
 * @property int $id_User_CreadoPor
 * @property int $id_User_ModificadoPor
 * @property string $fechaCreacion
 * @property string $fechaModificacion
 *
 * @property DirectorResponsableObra $alturaDRO
 * @property Archivo $archivoLicenciaConstruccionAreaPreexistenteFile
 * @property Archivo $archivoMecanicaSuelos
 * @property Archivo $archivoMemoriaCalculo
 * @property ConstanciaEscritura $constanciaEscritura
 * @property ConstanciaPosecionEjidal $constanciaPosecionEjidal
 * @property Contacto $contacto
 * @property DirectorResponsableObra $directorResponsableObra
 * @property Domicilio2 $domicilioNotificaciones
 * @property Domicilio2 $domicilioPredio
 * @property Escritura $escritura
 * @property Expediente[] $expedientes
 * @property GeneroConstruccion $generoConstruccion
 * @property DirectorResponsableObra $metrosLinealesDRO
 * @property MotivoConstruccion $motivoConstruccion
 * @property Persona $personaFisica
 * @property PersonaMoral $personaMoral
 * @property Persona[] $personas
 * @property SolicitudGenericaCuentaCon $solicitudGenericaCuentaCon
 * @property SolicitudGenericaHasDocumento[] $solicitudGenericaHasDocumentos
 * @property SolicitudGenericaHasPersona[] $solicitudGenericaHasPersonas
 * @property SubGeneroConstruccion $subGeneroConstruccion
 * @property TipoPredio $tipoPredio
 * @property User $userCreadoPor
 * @property User $userModificadoPor
 */
class SolicitudGenerica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudGenerica';
    }
    public const SCENARIO_CREATE_ESCRITURA_CONSTANCIA = 'CREATE_SOLICITUD_GENERICA';
    public const SCENARIO_CREATE_EJIDAL = 'CREATE_SOLICITUD_GENERICA';
    public const STATUS_SOLICITUD = 
    [
        //"EN CAPTURA",
        0=>"ESPERANDO VALIDACIÓN DE SOLICITUD",
        //"VALIDANDO SOLICITUD",
        201 => "SOLICITUD VALIDADA",//espera de entrega documentación faltante

        500 => "CANCELADA",
        //200 => "SOLICITUD APROBADA", //documentación faltante entregada
        200 => "EXPEDIENTE GENERADO"


    ];

    public const STATUS_EXPEDIENTE_GENERADO = 200;
    public const STATUS_VALIDADA = 201;
    
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        //$scenarios[self::SCENARIO_MANDATORY_FILE] = ['myFile']; //default scenario defined in rules function
        $scenarios[self::SCENARIO_CREATE_ESCRITURA_CONSTANCIA] = 
        [
            'fechaPagoAguaOContrato',
            'isSolicitaPersonaFisica', 
            'superficieTotal', 'niveles', 'numeroTomaAgua',
            'numeroReciboAgua', 'subeRecibo', 
            'numeroPredial','fechaPagoPredial',
            'id_MetrosLinealesDRO', 'id_AlturaDRO',           
            'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon',
            'id_TipoPredio', 
            'id_GeneroConstruccion', /* 'id_SubGeneroConstruccion', */
            'id_DirectorResponsableObra', 
            'superficiePorConstruir', 'areaPreExistente', 'altura', 'metrosLineales',
            'tipoTomaAgua',
        ];
        $scenarios[self::SCENARIO_CREATE_EJIDAL] = 
        [
            'fechaPagoAguaOContrato',
            'isSolicitaPersonaFisica', 
            'superficieTotal', 'niveles', 'numeroTomaAgua',
            'numeroReciboAgua', 'subeRecibo', 
            'id_MetrosLinealesDRO', 'id_AlturaDRO',           
            'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon',
            'id_TipoPredio', 
            'id_GeneroConstruccion', /* 'id_SubGeneroConstruccion', */
            'id_DirectorResponsableObra', 
            'superficiePorConstruir', 'areaPreExistente', 'altura', 'metrosLineales',
            'tipoTomaAgua',
        ];

        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusSolicitud', 'isSolicitaPersonaFisica', 'superficieTotal', 'niveles', 'numeroTomaAgua', 'numeroReciboAgua', 'subeRecibo', 'numeroPredial', 'id_MetrosLinealesDRO', 'id_AlturaDRO', 'id_PersonaFisica', 'id_PersonaMoral', 'id_Contacto', 'id_DomicilioNotificaciones', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Escritura', 'id_ConstanciaEscritura', 'id_ConstanciaPosecionEjidal', 'id_TipoPredio', 'id_GeneroConstruccion', 'id_SubGeneroConstruccion', 'id_DomicilioPredio', 'id_DirectorResponsableObra', 'id_Archivo_MemoriaCalculo', 'id_Archivo_MecanicaSuelos', 'id_Archivo_LicenciaConstruccionAreaPreexistenteFile', 'id_User_CreadoPor', 'id_User_ModificadoPor'], 'integer'],
            [['superficieTotal', 'numeroTomaAgua', 'fechaPagoAguaOContrato', 'id_Contacto', 'id_DomicilioNotificaciones', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_TipoPredio', 'id_GeneroConstruccion', 'id_DomicilioPredio', 'id_DirectorResponsableObra', 'id_User_CreadoPor', 'id_User_ModificadoPor', 'fechaCreacion', 'fechaModificacion'], 'required'],
            [['superficiePorConstruir', 'areaPreExistente', 'altura', 'metrosLineales'], 'number'],
            [['fechaPagoAguaOContrato', 'fechaPagoPredial', 'fechaCreacion', 'fechaModificacion'], 'safe'],
            [['tipoTomaAgua'], 'string', 'max' => 255],
            [['id_MetrosLinealesDRO'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_MetrosLinealesDRO' => 'id']],
            [['id_AlturaDRO'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_AlturaDRO' => 'id']],
            [['id_DirectorResponsableObra'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorResponsableObra::class, 'targetAttribute' => ['id_DirectorResponsableObra' => 'id']],
            [['id_User_CreadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_CreadoPor' => 'id']],
            [['id_User_ModificadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_User_ModificadoPor' => 'id']],
            [['id_MotivoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoConstruccion::class, 'targetAttribute' => ['id_MotivoConstruccion' => 'id']],
            [['id_DomicilioNotificaciones'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio2::class, 'targetAttribute' => ['id_DomicilioNotificaciones' => 'id']],
            [['id_DomicilioPredio'], 'exist', 'skipOnError' => true, 'targetClass' => Domicilio2::class, 'targetAttribute' => ['id_DomicilioPredio' => 'id']],
            [['id_TipoPredio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPredio::class, 'targetAttribute' => ['id_TipoPredio' => 'id']],
            [['id_Contacto'], 'exist', 'skipOnError' => true, 'targetClass' => Contacto::class, 'targetAttribute' => ['id_Contacto' => 'id']],
            [['id_GeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => GeneroConstruccion::class, 'targetAttribute' => ['id_GeneroConstruccion' => 'id']],
            [['id_SubGeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => SubGeneroConstruccion::class, 'targetAttribute' => ['id_SubGeneroConstruccion' => 'id']],
            [['id_PersonaFisica'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_PersonaFisica' => 'id']],
            [['id_PersonaMoral'], 'exist', 'skipOnError' => true, 'targetClass' => PersonaMoral::class, 'targetAttribute' => ['id_PersonaMoral' => 'id']],
            [['id_Escritura'], 'exist', 'skipOnError' => true, 'targetClass' => Escritura::class, 'targetAttribute' => ['id_Escritura' => 'id']],
            [['id_ConstanciaEscritura'], 'exist', 'skipOnError' => true, 'targetClass' => ConstanciaEscritura::class, 'targetAttribute' => ['id_ConstanciaEscritura' => 'id']],
            [['id_ConstanciaPosecionEjidal'], 'exist', 'skipOnError' => true, 'targetClass' => ConstanciaPosecionEjidal::class, 'targetAttribute' => ['id_ConstanciaPosecionEjidal' => 'id']],
            [['id_SolicitudGenericaCuentaCon'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudGenericaCuentaCon::class, 'targetAttribute' => ['id_SolicitudGenericaCuentaCon' => 'id']],
            [['id_Archivo_MemoriaCalculo'], 'exist', 'skipOnError' => true, 'targetClass' => Archivo::class, 'targetAttribute' => ['id_Archivo_MemoriaCalculo' => 'id']],
            [['id_Archivo_MecanicaSuelos'], 'exist', 'skipOnError' => true, 'targetClass' => Archivo::class, 'targetAttribute' => ['id_Archivo_MecanicaSuelos' => 'id']],
            [['id_Archivo_LicenciaConstruccionAreaPreexistenteFile'], 'exist', 'skipOnError' => true, 'targetClass' => Archivo::class, 'targetAttribute' => ['id_Archivo_LicenciaConstruccionAreaPreexistenteFile' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'statusSolicitud' => 'Status Solicitud',
            'isSolicitaPersonaFisica' => 'Is Solicita Persona Fisica',
            'superficieTotal' => 'Superficie Total',
            'niveles' => 'Niveles',
            'superficiePorConstruir' => 'Superficie Por Construir',
            'areaPreExistente' => 'Area Pre Existente',
            'tipoTomaAgua' => 'Tipo Toma Agua',
            'numeroTomaAgua' => 'Numero Toma Agua',
            'fechaPagoAguaOContrato' => 'Fecha Pago Agua O Contrato',
            'numeroReciboAgua' => 'Numero Recibo Agua',
            'subeRecibo' => 'Sube Recibo',
            'numeroPredial' => 'Numero Predial',
            'fechaPagoPredial' => 'Fecha Pago Predial',
            'altura' => 'Altura',
            'metrosLineales' => 'Metros Lineales',
            'id_MetrosLinealesDRO' => 'Id Metros Lineales Dro',
            'id_AlturaDRO' => 'Id Altura Dro',
            'id_PersonaFisica' => 'Id Persona Fisica',
            'id_PersonaMoral' => 'Id Persona Moral',
            'id_Contacto' => 'Id Contacto',
            'id_DomicilioNotificaciones' => 'Id Domicilio Notificaciones',
            'id_MotivoConstruccion' => 'Id Motivo Construccion',
            'id_SolicitudGenericaCuentaCon' => 'Id Solicitud Generica Cuenta Con',
            'id_Escritura' => 'Id Escritura',
            'id_ConstanciaEscritura' => 'Id Constancia Escritura',
            'id_ConstanciaPosecionEjidal' => 'Id Constancia Posecion Ejidal',
            'id_TipoPredio' => 'Id Tipo Predio',
            'id_GeneroConstruccion' => 'Id Genero Construccion',
            'id_SubGeneroConstruccion' => 'Id Sub Genero Construccion',
            'id_DomicilioPredio' => 'Id Domicilio Predio',
            'id_DirectorResponsableObra' => 'Id Director Responsable Obra',
            'id_Archivo_MemoriaCalculo' => 'Id Archivo Memoria Calculo',
            'id_Archivo_MecanicaSuelos' => 'Id Archivo Mecanica Suelos',
            'id_Archivo_LicenciaConstruccionAreaPreexistenteFile' => 'Id Archivo Licencia Construccion Area Preexistente File',
            'id_User_CreadoPor' => 'Id User Creado Por',
            'id_User_ModificadoPor' => 'Id User Modificado Por',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaModificacion' => 'Fecha Modificacion',
        ];
    }

        /**
     * Gets query for [[AlturaDRO]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlturaDRO()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_AlturaDRO']);
    }

    /**
     * Gets query for [[MetrosLinealesDRO]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetrosLinealesDRO()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_MetrosLinealesDRO']);
    }

    /**
     * Gets query for [[ArchivoLicenciaConstruccionAreaPreexistenteFile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoLicenciaConstruccionAreaPreexistenteFile()
    {
        return $this->hasOne(Archivo::class, ['id' => 'id_Archivo_LicenciaConstruccionAreaPreexistenteFile']);
    }

    /**
     * Gets query for [[ArchivoMecanicaSuelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoMecanicaSuelos()
    {
        return $this->hasOne(Archivo::class, ['id' => 'id_Archivo_MecanicaSuelos']);
    }

    /**
     * Gets query for [[ArchivoMemoriaCalculo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoMemoriaCalculo()
    {
        return $this->hasOne(Archivo::class, ['id' => 'id_Archivo_MemoriaCalculo']);
    }

    /**
     * Gets query for [[ConstanciaEscritura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstanciaEscritura()
    {
        return $this->hasOne(ConstanciaEscritura::class, ['id' => 'id_ConstanciaEscritura']);
    }

    /**
     * Gets query for [[ConstanciaPosecionEjidal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstanciaPosecionEjidal()
    {
        return $this->hasOne(ConstanciaPosecionEjidal::class, ['id' => 'id_ConstanciaPosecionEjidal']);
    }

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
     * Gets query for [[DirectorResponsableObra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorResponsableObra()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_DirectorResponsableObra']);
    }

    /**
     * Gets query for [[DirectorResponsableObra0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorResponsableObra0()
    {
        return $this->hasOne(DirectorResponsableObra::class, ['id' => 'id_DirectorResponsableObra']);
    }

    /**
     * Gets query for [[DomicilioNotificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioNotificaciones()
    {
        return $this->hasOne(Domicilio2::class, ['id' => 'id_DomicilioNotificaciones']);
    }

    /**
     * Gets query for [[DomicilioPredio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioPredio()
    {
        return $this->hasOne(Domicilio2::class, ['id' => 'id_DomicilioPredio']);
    }

    /**
     * Gets query for [[Escritura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEscritura()
    {
        return $this->hasOne(Escritura::class, ['id' => 'id_Escritura']);
    }

    /**
     * Gets query for [[Expedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(Expediente::class, ['id_SolicitudGenerica' => 'id']);
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
     * Gets query for [[PersonaFisica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaFisica()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_PersonaFisica']);
    }

    /**
     * Gets query for [[PersonaMoral]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaMoral()
    {
        return $this->hasOne(PersonaMoral::class, ['id' => 'id_PersonaMoral']);
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::class, ['id' => 'id_Persona'])->viaTable('SolicitudGenerica_has_Persona', ['id_SolicitudGenerica' => 'id']);
    }

    /**
     * Gets query for [[SolicitudGenericaCuentaCon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaCuentaCon()
    {
        return $this->hasOne(SolicitudGenericaCuentaCon::class, ['id' => 'id_SolicitudGenericaCuentaCon']);
    }

    /**
     * Gets query for [[SolicitudGenericaHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaHasDocumentos()
    {
        return $this->hasMany(SolicitudGenerica_has_Documento::class, ['id_SolicitudGenerica' => 'id']);
    }

    /**
     * Gets query for [[SolicitudGenericaHasPersonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaHasPersonas()
    {
        return $this->hasMany(SolicitudGenerica_has_Persona::class, ['id_SolicitudGenerica' => 'id']);
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
