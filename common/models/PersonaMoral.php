<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "PersonaMoral".
 *
 * @property int $id
 * @property string $rfc
 * @property string $denominacion
 */
class PersonaMoral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PersonaMoral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rfc', 'denominacion'], 'required'],
            [['rfc'], 'string', 'max' => 50],
            [['denominacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rfc' => 'RFC',
            'denominacion' => 'Denominación',
        ];
    }
}
