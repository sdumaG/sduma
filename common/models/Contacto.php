<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Contacto".
 *
 * @property int $id
 * @property string $email
 * @property string $telefono
 *
 * @property SolicitudConstruccion[] $solicitudConstruccions
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'telefono'], 'required'],
            [['email', 'telefono'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'email' => 'Email',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_Contacto' => 'Id']);
    }
}
