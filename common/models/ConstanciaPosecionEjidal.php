<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ConstanciaPosecionEjidal".
 *
 * @property int $id
 * @property int $noConstanciaPosEjidal
 * @property string $nombreQuienEmitio
 * @property string $fechaEmision
 */
class ConstanciaPosecionEjidal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ConstanciaPosecionEjidal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noConstanciaPosEjidal', 'nombreQuienEmitio', 'fechaEmision'], 'required'],
            [['noConstanciaPosEjidal'], 'integer'],
            [['fechaEmision'], 'safe'],
            [['nombreQuienEmitio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noConstanciaPosEjidal' => 'No Constancia Poseción Ejidal',
            'nombreQuienEmitio' => 'Nombre de quién emitió',
            'fechaEmision' => 'Fecha de emisión',
        ];
    }
}
