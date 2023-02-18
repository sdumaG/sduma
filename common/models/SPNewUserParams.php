<?php

namespace common\models;

use Yii;
use yii\base\Model;

class SPNewUserParams extends Model{

    public $username;
    public $email;
    public $password_hash;
    public $auth_key;
    public $password_reset_token;
    public $verification_token;
    public $nombre;
    public $apellidoP;
    public $apellidoM;

    public function rules(){
        
    }

}