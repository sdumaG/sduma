<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Escritura".
 *
 * @property int $id
 * @property int $noEscritura
 * @property int $noRegistro
 * @property int $noTomo
 */
class Escritura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Escritura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noEscritura', 'noRegistro', 'noTomo'], 'required'],
            [['noEscritura', 'noRegistro', 'noTomo'], 'integer'],
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
            'noRegistro' => 'No Registro',
            'noTomo' => 'No Tomo',
        ];
    }
}
