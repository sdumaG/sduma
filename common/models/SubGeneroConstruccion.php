<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SubGeneroConstruccion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $udm
 * @property float $tamanioLimiteInferior
 * @property float $tamanioLimiteSuperior
 * @property string $nombreTarifa
 * @property float $tarifa
 * @property string $fechaCreacion
 * @property string $anioVigencia
 * @property int $isActivo
 * @property int $id_GeneroConstruccion
 *
 * @property GeneroConstruccion $generoConstruccion
 * @property SolicitudConstruccion[] $solicitudConstruccions
 */
class SubGeneroConstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SubGeneroConstruccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'udm', 'tamanioLimiteInferior', 'tamanioLimiteSuperior', 'nombreTarifa', 'tarifa', 'fechaCreacion', 'anioVigencia', 'id_GeneroConstruccion'], 'required'],
            [['tamanioLimiteInferior', 'tamanioLimiteSuperior', 'tarifa'], 'number'],
            [['fechaCreacion'], 'safe'],
            [['isActivo', 'id_GeneroConstruccion'], 'integer'],
            [['nombre', 'nombreTarifa', 'anioVigencia'], 'string', 'max' => 45],
            [['udm'], 'string', 'max' => 10],
            [['id_GeneroConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => GeneroConstruccion::class, 'targetAttribute' => ['id_GeneroConstruccion' => 'id']],
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
            'udm' => 'Udm',
            'tamanioLimiteInferior' => 'Limite Inferior',
            'tamanioLimiteSuperior' => 'Limite Superior',
            'nombreTarifa' => 'Nombre Tarifa',
            'tarifa' => 'Tarifa',
            'fechaCreacion' => 'Creacion',
            'anioVigencia' => 'Año Vigencia',
            'isActivo' => 'Is Activo',
            'id_GeneroConstruccion' => 'Id Genero Construccion',
        ];
    }

    /**
     * Gets query for [[GeneroConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGeneroConstruccion()
    {
        return $this->hasOne(GeneroConstruccion::class, ['id' => 'id_GeneroConstruccion']);
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_SubGeneroConstruccion' => 'id']);
    }
}
