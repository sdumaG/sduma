<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TipoTramite_has_Documento".
 *
 * @property int $id_TipoTramite
 * @property int $id_Documento
 *
 * @property Documento $documento
 * @property TipoTramite $tipoTramite
 */
class TipoTramiteHasDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TipoTramite_has_Documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Documento'], 'required'],
            [['id_Documento'], 'integer'],
            [['id_TipoTramite'], 'exist', 'skipOnError' => true, 'targetClass' => TipoTramite::class, 'targetAttribute' => ['id_TipoTramite' => 'id']],
            [['id_Documento'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['id_Documento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_TipoTramite' => 'Id Tipo Tramite',
            'id_Documento' => 'Id Documento',
        ];
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
     * Gets query for [[TipoTramite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTramite()
    {
        return $this->hasOne(TipoTramite::class, ['id' => 'id_TipoTramite']);
    }
}
