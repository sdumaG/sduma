<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "GeneroConstruccion".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 *
 * @property SolicitudConstruccion[] $solicitudConstruccions
 * @property SubGeneroConstruccion[] $subGeneroConstruccions
 */
class GeneroConstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'GeneroConstruccion';
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
        return $this->hasMany(SolicitudConstruccion::class, ['id_GeneroConstruccion' => 'id']);
    }

    /**
     * Gets query for [[SubGeneroConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubGeneroConstruccions()
    {
        return $this->hasMany(SubGeneroConstruccion::class, ['id_GeneroConstruccion' => 'id']);
    }
}
