<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SolicitudConstruccion_has_Documento".
 *
 * @property int $id_SolicitudConstruccion
 * @property int $id_Documento
 * @property int $isEntregado
 * @property string $nombreArchivo
 * @property string $path
 * @property string $realNombreArchivo
 *
 * @property Documento $documento
 * @property SolicitudConstruccion $solicitudConstruccion
 */
class SolicitudConstruccionHasDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SolicitudConstruccion_has_Documento';
    }
    
    const SCENARIO_CREATE = 'CREATE_SOLI';
    const SCENARIO_UPDATE = 'UPDATE_SOLI';
 
    public function scenarios()
    {
        $scenarios = parent::scenarios();//incluye el default

        $scenarios[ self::SCENARIO_CREATE] =   [/* 'id_SolicitudConstruccion', */'id_Documento'];
        $scenarios[ self::SCENARIO_UPDATE] =   [/* 'id_SolicitudConstruccion', */'id_Documento','isEntregado'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_SolicitudConstruccion', 'id_Documento', 'isEntregado'], 'required'],
            [['id_SolicitudConstruccion', 'id_Documento', 'isEntregado'], 'integer'],
            [['nombreArchivo', 'path'], 'string', 'max' => 128],
            [['realNombreArchivo'], 'string', 'max' => 90],
            [['id_Documento', 'id_SolicitudConstruccion'], 'unique', 'targetAttribute' => ['id_Documento', 'id_SolicitudConstruccion']],
            [['id_Documento'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['id_Documento' => 'id']],
            [['id_SolicitudConstruccion'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudConstruccion::class, 'targetAttribute' => ['id_SolicitudConstruccion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_SolicitudConstruccion' => 'Id Solicitud Construccion',
            'id_Documento' => 'Id Documento',
            'isEntregado' => 'Is Entregado',
            'nombreArchivo' => 'Nombre Archivo',
            'path' => 'Path',
            'realNombreArchivo' => 'Real Nombre Archivo',
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
     * Gets query for [[SolicitudConstruccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccion()
    {
        return $this->hasOne(SolicitudConstruccion::class, ['id' => 'id_SolicitudConstruccion']);
    }
}
