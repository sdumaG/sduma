<?php 

namespace common\models;

use Yii;


class UtilVic{


    public static function isEmployee(){        
        $user =Yii::$app->user->identity;

        //si no hay sesión, automaticamente false.
        if(!$user) return false;
        $userSrc = User::getUserSrcTruth($user->username);


        switch ($userSrc->id_UserLevel) {
            case User::USER_LEVEL_ADMIN:
            case User::USER_LEVEL_INTERNO:
                    return true;
                break;
            default:
                return false;
                break;
        }

    }

}




?>