<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Persona;
use common\models\SPNewUserParams;
use Exception;
use Faker\Provider\ar_EG\Person;
use yii\debug\models\search\Log;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    /* VIC COMPLEMENTS */
    public $nombre;
    public $apellidoP;
    public $apellidoM;

 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe, elija otro.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya está asociado a una cuenta.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        
            ['nombre', 'required'],
            ['nombre', 'string', 'max' => 255],

            ['apellidoP', 'required'],
            ['apellidoP', 'string', 'max' => 255 /* (new Persona)->getValidators()[1]->max */],
            
           /*  ['apellidoM', 'required'], */
            ['apellidoM', 'string', 'max' => 255 ],

        
        ];
    }

    public function attributeLabels()
    {    
        return array(

            'nombre' => 'Nombre',
            'apellidoP' => 'Apellido Paterno',
            'apellidoM' => 'Apellido Materno',
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
    
        );
    
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
       
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);//pass hash
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $newUser = new SPNewUserParams();
        $newUser->username = $user->username;
        $newUser->email = $user->email;

        $newUser->auth_key = $user->auth_key;
        $newUser->password_hash = $user->password_hash;;
        $newUser->password_reset_token = $user->password_reset_token;//empty
        $newUser->verification_token = $user->verification_token;

        $newUser->nombre = $this->nombre ;
        $newUser->apellidoP = $this->apellidoP;
        $newUser->apellidoM = $this->apellidoM;


        /* SE PUEDE HACER ASI POR PARTES; pero mejor uso el SP */
      /*   $datosPersona = new Persona();
        $datosPersona->apellidoP =  $this->apellidoP;
        $datosPersona->nombre =      $this->nombre  ;
        $datosPersona->apellidoM =  $this->apellidoM; */

        
        /* 
         0 -> error crear user
         1 -> error user created but email
         2 -> success
        */
        $resSignup = [];
        
        $userCreationResult = $this->createUser($newUser) ;

        if($userCreationResult["ROWS_INSERTED"]  == 2){//true

            if($this->sendEmail($newUser)){
                return [
                    "success" => true, 
                    "MSG"=> ""
                ];
            }else{
                return [
                    "success" => false, 
                    "MSG"=> "Error al enviar el correo de verificación. Vaya a la pantalla de inicio de sesión y de click en 'Reenviar Verificación."
                ];
            }


        }else{//fail so return message
            return [
                    "success" => false, 
                    "MSG"=> "Error al crear usuario: {$userCreationResult['ERROR_MSG']} "
            ];
        }
        //return $resSignup;
        /* $user->save() */  
       
    }
 
     /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function createUser($newUser){

        $sql ="  EXEC sp_create_user :username,:email,:password_hash,:auth_key,:password_reset_token ,:verification_token,:nombre,:apellidoP,:apellidoM; ";
        $params =[
                ':username'=>$newUser->username,
                ':email'=>$newUser->email,
                ':password_hash'=>$newUser->password_hash,
                ':auth_key'=>$newUser->auth_key,
                ':password_reset_token'=>$newUser->password_reset_token,
                ':verification_token'=>$newUser->verification_token,
                ':nombre'=>$newUser->nombre,
                ':apellidoP'=>$newUser->apellidoP,
                ':apellidoM'=>$newUser->apellidoM
        ];
        $sql2 = "EXEC sduma.dbo.testSP :vicParam";
         
        /* ->bindValue(':username',$newUser->username)
        ->bindValue(':email',$newUser->email)
        ->bindValue(':password_hash',$newUser->password_hash)
        ->bindValue(':auth_key',$newUser->auth_key)
        ->bindValue(':password_reset_token',$newUser->password_reset_token)
        ->bindValue(':verification_token',$newUser->verification_token)
        ->bindValue(':nombre',$newUser->nombre)
        ->bindValue(':apellidoP',$newUser->apellidoP)
        ->bindValue(':apellidoM',$newUser->apellidoM); */
        $res = -1;
        try{
            $rows =  Yii::$app->db->createCommand($sql, $params) ->queryAll( );

            $res = $rows[0]["ROWS_INSERTED"] ;

        }
        catch(Exception $ex){
            Yii::info($ex, $category = 'DBBB');
            return ["ROWS_INSERTED" => -1, "ERROR_MSG" => $ex->getMessage()];
        }
        Yii::info($res, $category = 'DB ACTION');
        return ["ROWS_INSERTED" =>  $res ]; 
 
        

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($userr)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $userr]
            )
            ->setFrom(['vicsdumae@gmail.com'/* Yii::$app->params['supportEmail']  */=> Yii::$app->name . ' robot'])
            ->setTo($userr->email)
            ->setSubject('Registro de cuenta en ' . Yii::$app->name)
            ->send();
    }
}
