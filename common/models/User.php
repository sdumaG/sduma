<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * 
 * Tambien
 * ,[id_Datos_Persona]
 *     ,[id_Horario]
 *     ,[id_UserLevel]
 *   ,[verification_token]
 * @property common\models\Persona $datosPersona
 */

 /* 
 NO SOBREESCRIBIR CON EL GENERADOR gii, 
 ESTA CLASE SE MODIFICÓ MANUALMENTE, 
 
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    const USER_LEVEL_ADMIN = 3;
    const USER_LEVEL_INTERNO = 2;
    const USER_LEVEL_EXTERNO = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /* TimestampBehavior::class, */
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'auth_key', 'password_hash', 'email', /* 'created_at', 'updated_at', */ 'id_Datos_Persona'], 'required'],
            [['status', /* 'created_at', 'updated_at', */ 'id_Datos_Persona', 'id_Horario', 'id_UserLevel'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['id_Horario'], 'exist', 'skipOnError' => true, 'targetClass' => Horario::class, 'targetAttribute' => ['id_Horario' => 'id']],
            
            [['id_UserLevel'], 'exist', 'skipOnError' => true, 'targetClass' => Userlevel::class, 'targetAttribute' => ['id_UserLevel' => 'id']],
            ['id_UserLevel', 'default', 'value' => 1],
            ['id_UserLevel', 'in', 'range' => [self::USER_LEVEL_INTERNO,self::USER_LEVEL_EXTERNO, self::USER_LEVEL_ADMIN]],

            [['id_Datos_Persona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::class, 'targetAttribute' => ['id_Datos_Persona' => 'id']],
        ];
    }
    public static function isUserAdmin($username)
    {

        if (static::findOne(['username' => $username, 'id_UserLevel' => self::USER_LEVEL_ADMIN])){
                            
                return true;
        } else {
                            
                return false;
        }
            
    }

    public static function getUserSrcTruth($username){

        return static::findOne(['username'=>$username]);

    }


    public static function isSDUMAEmployee($username)
    {
        
        if(static::findOne([
            'username'=>$username, 'id_UserLevel'=>[User::USER_LEVEL_INTERNO,User::USER_LEVEL_ADMIN]
            ]
            )){
                return true;
            }
            return false;

    }
    
    /**
     * Gets query for [[DatosPersona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersona()
    {
        return $this->hasOne(Persona::class, ['id' => 'id_Datos_Persona']);
    }


    /**
     * Gets query for [[Horario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHorario()
    {
        return $this->hasOne(Horario::class, ['id' => 'id_Horario']);
    }

  /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
           /*  'created_at' => 'Creado en',
            'updated_at' => 'Actualizado en', */
            'id_Datos_Persona' => 'Id Datos Persona',
            'id_Horario' => 'Id Horario',
            'id_UserLevel' => 'Id User Level',
            'verification_token' => 'Verification Token',
            'createdAt' => 'Creado en',
            'updatedAt' => 'Actualizado en'

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
