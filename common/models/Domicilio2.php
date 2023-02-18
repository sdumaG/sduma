<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Domicilio2".
 *
 * @property int $id
 * @property string $coloniaFraccBarrio
 * @property string $calle
 * @property string|null $numExt
 * @property string|null $numInt
 * @property string $cp
 * @property string|null $calleOriente
 * @property string|null $callePoniente
 * @property string|null $calleNorte
 * @property string|null $calleSur
 */
class Domicilio2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Domicilio2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coloniaFraccBarrio', 'calle', 'cp'], 'required'],
            [['coloniaFraccBarrio', 'calleOriente', 'callePoniente', 'calleNorte', 'calleSur'], 'string', 'max' => 90],
            [['calle', 'numExt', 'numInt'], 'string', 'max' => 45],
            [['cp'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coloniaFraccBarrio' => 'Colonia Fracc Barrio',
            'calle' => 'Calle',
            'numExt' => 'Num Ext',
            'numInt' => 'Num Int',
            'cp' => 'Cp',
            'calleOriente' => 'Calle Oriente',
            'callePoniente' => 'Calle Poniente',
            'calleNorte' => 'Calle Norte',
            'calleSur' => 'Calle Sur',
        ];
    }
}
