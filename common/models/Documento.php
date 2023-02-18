<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Documento".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isActivo
 * @property int $isSoloEntregaFisica
 * @property int $hasMultipleArchivo
 *
 * @property TipoTramiteHasDocumento[] $tipoTramiteHasDocumentos
 * @property TipoTramite[] $tipoTramites
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['isActivo', 'isSoloEntregaFisica', 'hasMultipleArchivo'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
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
            'isSoloEntregaFisica' => 'Is Solo Entrega Fisica',
            'hasMultipleArchivo' => 'Has Multiple Archivo',
        ];
    }

    /**
     * Gets query for [[TipoTramiteHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramiteHasDocumentos()
    {
        return $this->hasMany(TipoTramiteHasDocumento::class, ['id_Documento' => 'id']);
    }

    /**
     * Gets query for [[TipoTramites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramites()
    {
        return $this->hasMany(TipoTramite::class, ['id' => 'id_TipoTramite'])->viaTable('TipoTramite_has_Documento', ['id_Documento' => 'id']);
    }
}
