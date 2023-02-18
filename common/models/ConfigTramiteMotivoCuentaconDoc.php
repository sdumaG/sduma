<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ConfigTramiteMotivoCuentaconDoc".
 *
 * @property int $id_TipoTramite
 * @property int $id_MotivoConstruccion
 * @property int $id_SolicitudGenericaCuentaCon
 * @property int $id_Documento
 *
 * @property Documento $documento
 * @property MotivoConstruccion $motivoConstruccion
 * @property SolicitudGenericaCuentaCon $solicitudGenericaCuentaCon
 * @property TipoTramite $tipoTramite
 */
class ConfigTramiteMotivoCuentaconDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ConfigTramiteMotivoCuentaconDoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_TipoTramite', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Documento'], 'required'],
            [['id_TipoTramite', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_Documento'], 'integer'],
            [['id_Documento', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_TipoTramite'], 'unique', 'targetAttribute' => ['id_Documento', 'id_MotivoConstruccion', 'id_SolicitudGenericaCuentaCon', 'id_TipoTramite']],
            [['id_TipoTramite'], 'exist', 'skipOnError' => true, 'targetClass' => TipoTramite::class, 'targetAttribute' => ['id_TipoTramite' => 'id']],
            [['id_MotivoConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoConstruccion::class, 'targetAttribute' => ['id_MotivoConstruccion' => 'id']],
            [['id_SolicitudGenericaCuentaCon'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudGenericaCuentaCon::class, 'targetAttribute' => ['id_SolicitudGenericaCuentaCon' => 'id']],
            [['id_Documento'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['id_Documento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_TipoTramite' => 'Id Tipo Tramite',
            'id_MotivoConstruccion' => 'Id Motivo Construccion',
            'id_SolicitudGenericaCuentaCon' => 'Id Solicitud Generica Cuenta Con',
            'id_Documento' => 'Id Documento',
        ];
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::class, ['id' => 'id_Documento']);
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
     * Gets query for [[SolicitudGenericaCuentaCon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaCuentaCon()
    {
        return $this->hasOne(SolicitudGenericaCuentaCon::class, ['id' => 'id_SolicitudGenericaCuentaCon']);
    }

    /**
     * Gets query for [[TipoTramite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramite()
    {
        return $this->hasOne(TipoTramite::class, ['id' => 'id_TipoTramite']);
    }
}
