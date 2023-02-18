<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Archivo".
 *
 * @property int $id
 * @property string $nombreArchivo
 * @property string $path
 * @property string $realNombreArchivo
 *
 * @property SolicitudGenericaHasDocumento[] $solicitudGenericaHasDocumentos
 * @property SolicitudGenerica[] $solicitudGenericas
 * @property SolicitudGenerica[] $solicitudGenericas0
 * @property SolicitudGenerica[] $solicitudGenericas1
 */
class Archivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Archivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreArchivo', 'path', 'realNombreArchivo'], 'required'],
            [['nombreArchivo', 'path', 'realNombreArchivo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreArchivo' => 'Nombre Archivo',
            'path' => 'Path',
            'realNombreArchivo' => 'Real Nombre Archivo',
        ];
    }

    /**
     * Gets query for [[SolicitudGenericaHasDocumentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericaHasDocumentos()
    {
        return $this->hasMany(SolicitudGenericaHasDocumento::class, ['id_Archivo' => 'id']);
    }

    /**
     * Gets query for [[SolicitudGenericas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericas()
    {
        return $this->hasMany(SolicitudGenerica::class, ['id_Archivo_MemoriaCalculo' => 'id']);
    }

    /**
     * Gets query for [[SolicitudGenericas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericas0()
    {
        return $this->hasMany(SolicitudGenerica::class, ['id_Archivo_MecanicaSuelos' => 'id']);
    }

    /**
     * Gets query for [[SolicitudGenericas1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenericas1()
    {
        return $this->hasMany(SolicitudGenerica::class, ['id_Archivo_LicenciaConstruccionAreaPreexistenteFile' => 'id']);
    }
}
