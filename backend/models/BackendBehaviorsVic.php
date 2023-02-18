<?php

namespace backend\models;
 
use Yii;
use common\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BackendBehaviorsVic{

    //serán 
    public static function BackendBehaviors($actions){
        return [
            'access' => [

                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ]/* ,
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ] */
                    ,
                    [
                        'actions' => $actions/* ['config','logout', 'index'] */,
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                               ob_start();  
                               var_dump("BEHAVIORS:");  
                             var_dump($rule); 
                             var_dump($action);  
                             Yii::debug(ob_get_clean(),__METHOD__);  
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

}


?>