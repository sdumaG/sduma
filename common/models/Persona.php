<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidoP
 * @property string|null $apellidoM
 *
 * @property Corrseguridadestruc[] $corrseguridadestrucs
 * @property Directorresponsableobra[] $directorresponsableobras
 * @property Expediente[] $expedientes
 * @property Solicitudconstruccion[] $solicitudConstruccions
 * @property SolicitudconstruccionHasPersona[] $solicitudconstruccionHasPersonas
 * @property User[] $users
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellidoP'], 'required'],
            [['nombre', 'apellidoP', 'apellidoM'], 'string', 'max' => 255],
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
            'apellidoP' => 'Apellido Paterno',
            'apellidoM' => 'Apellido Materno',
        ];
    }

    /**
     * Gets query for [[Corrseguridadestrucs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorrseguridadestrucs()
    {
        return $this->hasMany(Corrseguridadestruc::class, ['id_Persona' => 'id']);
    }

    /**
     * Gets query for [[Directorresponsableobras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorresponsableobras()
    {
        return $this->hasMany(Directorresponsableobra::class, ['id_Persona' => 'id']);
    }

    /**
     * Gets query for [[Expedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(Expediente::class, ['id_Persona_Solicita' => 'id']);
    }

    /**
     * Gets query for [[SolicitudConstruccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudConstruccions()
    {
        return $this->hasMany(Solicitudconstruccion::class, ['Id' => 'SolicitudConstruccion_Id'])->viaTable('solicitudconstruccion_has_persona', ['Persona_id' => 'id']);
    }

    /**
     * Gets query for [[SolicitudconstruccionHasPersonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudconstruccionHasPersonas()
    {
        return $this->hasMany(SolicitudconstruccionHasPersona::class, ['Persona_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_Datos_Persona' => 'id']);
    }
}
