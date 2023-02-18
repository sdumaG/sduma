<?php

use common\models\User;
use common\models\UserLevel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //    'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            /* 'status', */
            [
                'label' => "Estado",
                 
                'value' => function($currUser){
                    switch($currUser->status){
                        case  User::STATUS_DELETED:     return "ELIMINADO"; break;
                        case  User::STATUS_INACTIVE:    return "INACTIVO";  break;
                        case  User::STATUS_ACTIVE:      return "ACTIVO";    break;
                        default: return "DESCONOCIDO";//peligro xd
                    }
                      
                }
            ],
            /* 'id_Datos_Persona', */
            [
                'label' => "Nombre",
                'value' => function($currUser){return $currUser->datosPersona->nombre." ".$currUser->datosPersona->apellidoP;}

            ],
            [
                'label' => "Horario",
                'value' => function($currUser){return $currUser->horario->nombre;}

            ],
            /* 'id_Horario', */
            /* 'id_UserLevel', */
            [
                'label' => "Nivel acceso",
                 
                'value' => function($currUser){

                    return UserLevel::findOne(["id"=>$currUser->id_UserLevel])->Nombre;
                    /* switch($currUser->id_UserLevel){
                        case  User::USER_LEVEL_ADMIN:     return "ADMINISTRADOR"; break;
                        case  User::USER_LEVEL_INTERNO:    return "INTERNO";  break;
                        case  User::USER_LEVEL_EXTERNO:      return "EXTERNO";    break;
                        default: return "DESCONOCIDO";//peligro xd
                    } */
                      
                }
            ],
           /*  'createdAt', */
            ['label'=>'Creado en',
                'value' => function($currUser){                    
                   return date("d/m/y h:i a",  strtotime( $currUser->createdAt)   );  
                }  
            ],
            //'updatedAt',
            //'verification_token',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                  /*   if($action == "view") return null; */
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'visibleButtons'=>[                    
                    'view' => false
                ]
            ],
        ],
    ]); ?>


</div>
