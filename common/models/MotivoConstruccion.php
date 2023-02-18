<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "MotivoConstruccion".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 *
 * @property SolicitudConstruccion[] $solicitudConstruccions
 */
class MotivoConstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MotivoConstruccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['isActivo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
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

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_MotivoConstruccion' => 'id']);
    }
}
