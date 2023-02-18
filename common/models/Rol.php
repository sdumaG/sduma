<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Rol".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property UserHasRol[] $userHasRols
 * @property User[] $users
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * Gets query for [[UserHasRols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasRols()
    {
        return $this->hasMany(UserHasRol::class, ['id_Rol' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'id_User'])->viaTable('User_has_Rol', ['id_Rol' => 'id']);
    }
}
