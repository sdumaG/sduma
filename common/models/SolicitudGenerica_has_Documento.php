<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudGenerica_has_Documento".
 *
 * @property int $id_SolicitudGenerica
 * @property int $id_Documento
 * @property int|null $id_Archivo
 * @property int $isEntregado
 *
 * @property Archivo $archivo
 * @property Documento $documento
 * @property SolicitudGenerica $solicitudGenerica
 */
class SolicitudGenerica_has_Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudGenerica_has_Documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_SolicitudGenerica', 'id_Documento'], 'required'],
            [['id_SolicitudGenerica', 'id_Documento', 'id_Archivo', 'isEntregado'], 'integer'],
            [['id_SolicitudGenerica'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudGenerica::class, 'targetAttribute' => ['id_SolicitudGenerica' => 'id']],
            [['id_Documento'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['id_Documento' => 'id']],
            [['id_Archivo'], 'exist', 'skipOnError' => true, 'targetClass' => Archivo::class, 'targetAttribute' => ['id_Archivo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_SolicitudGenerica' => 'Id Solicitud Generica',
            'id_Documento' => 'Id Documento',
            'id_Archivo' => 'Id Archivo',
            'isEntregado' => 'Is Entregado',
        ];
    }

    /**
     * Gets query for [[Archivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivo()
    {
        return $this->hasOne(Archivo::class, ['id' => 'id_Archivo']);
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::class, ['id' => 'id_Documento']);
    }

    /**
     * Gets query for [[SolicitudGenerica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudGenerica()
    {
        return $this->hasOne(SolicitudGenerica::class, ['id' => 'id_SolicitudGenerica']);
    }
}
