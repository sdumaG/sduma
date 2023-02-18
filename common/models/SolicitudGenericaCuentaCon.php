<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudGenericaCuentaCon".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 */
class SolicitudGenericaCuentaCon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudGenericaCuentaCon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['isActivo'], 'integer'],
            [['nombre'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'isActivo' => 'Is Activo',
        ];
    }
}
