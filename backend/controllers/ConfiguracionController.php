<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class ConfiguracionController extends Controller{

    public function behaviors()
    {
        return \backend\models\BackendBehaviorsVic::BackendBehaviors(['config', 'index']);

    }


    public function actions()
    {

        return[
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



     /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        /* Solo admins pueden iniciar */
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

 
        $this->layout = 'blank';

        $model = new LoginForm();
        if (
            $model->load(Yii::$app->request->post()) 
            && $model->loginAdmin() 
        ) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }


     /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}