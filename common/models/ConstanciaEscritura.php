<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ConstanciaEscritura".
 *
 * @property int $id
 * @property int $noEscritura
 * @property int $noNotaria
 * @property string $fechaEmision
 */
class ConstanciaEscritura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ConstanciaEscritura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noEscritura', 'noNotaria', 'fechaEmision'], 'required'],
            [['noEscritura', 'noNotaria'], 'integer'],
            [['fechaEmision'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noEscritura' => 'No Escritura',
            'noNotaria' => 'No Notaria',
            'fechaEmision' => 'Fecha Emision',
        ];
    }
}
