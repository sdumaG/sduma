<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "DirectorResponsableObra".
 *
 * @property int $id
 * @property string $titulo
 * @property string $abreviacion
 * @property string $cedula
 * @property int $isActivo
 * @property int $id_Persona
 *
 * @property Persona $persona
 * @property SolicitudConstruccion[] $solicitudConstruccions
 */
class DirectorResponsableObra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DirectorResponsableObra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'abreviacion', 'cedula', 'id_Persona'], 'required'],
            [['isActivo', 'id_Persona'], 'integer'],
            [['titulo', 'cedula'], 'string', 'max' => 45],
            [['abreviacion'], 'string', 'max' => 10],
            [['id_Persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_Persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'abreviacion' => 'Abreviacion',
            'cedula' => 'Cedula',
            'isActivo' => 'Is Activo',
            'id_Persona' => 'Id Persona',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_Persona']);
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(SolicitudConstruccion::class, ['id_DirectorResponsableObra' => 'id']);
    }
}
