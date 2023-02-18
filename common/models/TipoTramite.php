<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TipoTramite".
 *
 * @property int $id
 * @property string $nombre
 * @property string $isActivo
 *
 * @property Documento[] $documentos
 * @property TipoTramiteHasDocumento[] $tipoTramiteHasDocumentos
 */
class TipoTramite extends \yii\db\ActiveRecord
{

    const TIPO_TRAMITE_CONSTRUCCION = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TipoTramite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'isActivo'], 'string', 'max' => 45],
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
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::class, ['id' => 'id_Documento'])->viaTable('TipoTramite_has_Documento', ['id_TipoTramite' => 'id']);
    }

    /**
     * Gets query for [[TipoTramiteHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramiteHasDocumentos()
    {
        return $this->hasMany(TipoTramiteHasDocumento::class, ['id_TipoTramite' => 'id']);
    }
}
