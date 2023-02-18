<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudGenerica_has_Persona".
 *
 * @property int $id_SolicitudGenerica
 * @property int $id_Persona
 *
 * @property Persona $persona
 * @property SolicitudGenerica $solicitudGenerica
 */
class SolicitudGenerica_has_Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudGenerica_has_Persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_SolicitudGenerica', 'id_Persona'], 'required'],
            [['id_SolicitudGenerica', 'id_Persona'], 'integer'],
            [['id_Persona', 'id_SolicitudGenerica'], 'unique', 'targetAttribute' => ['id_Persona', 'id_SolicitudGenerica']],
            [['id_SolicitudGenerica'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudGenerica::class, 'targetAttribute' => ['id_SolicitudGenerica' => 'id']],
            [['id_Persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_Persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_SolicitudGenerica' => 'Id Solicitud Generica',
            'id_Persona' => 'Id Persona',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_Persona']);
    }

    /**
     * Gets query for [[SolicitudGenerica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenerica()
    {
        return $this->hasOne(SolicitudGenerica::class, ['id' => 'id_SolicitudGenerica']);
    }
}
