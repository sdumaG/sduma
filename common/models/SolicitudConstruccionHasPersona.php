<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudConstruccion_has_Persona".
 *
 * @property int $SolicitudConstruccion_Id
 * @property int $Persona_id
 *
 * @property Persona $persona
 * @property SolicitudConstruccion $solicitudConstruccion
 */
class SolicitudConstruccionHasPersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudConstruccion_has_Persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SolicitudConstruccion_Id', 'Persona_id'], 'required'],
            [['SolicitudConstruccion_Id', 'Persona_id'], 'integer'],
            [['Persona_id', 'SolicitudConstruccion_Id'], 'unique', 'targetAttribute' => ['Persona_id', 'SolicitudConstruccion_Id']],
            [['Persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['Persona_id' => 'id']],
            [['SolicitudConstruccion_Id'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudConstruccion::class, 'targetAttribute' => ['SolicitudConstruccion_Id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SolicitudConstruccion_Id' => 'Solicitud Construccion ID',
            'Persona_id' => 'Persona ID',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::class, ['id' => 'Persona_id']);
    }

    /**
     * Gets query for [[SolicitudConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccion()
    {
        return $this->hasOne(SolicitudConstruccion::class, ['id' => 'SolicitudConstruccion_Id']);
    }
}
