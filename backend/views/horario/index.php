<?php

use common\models\Horario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\HorarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Horarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Horario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
     //   'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
           /*  'inicioActividad:time',
            'finActividad:time', */
            ['label'=>'Inicio Actividad',
                'value' => function($currHorario){                    
                   return date("h:i a",  strtotime( $currHorario->inicioActividad)   );  
                }  
            ],
            ['label'=>'Fin Actividad',
                'value' => function($currHorario){                    
                   return date("h:i a",  strtotime( $currHorario->finActividad)   );  
                }  
            ],
          
            [
            'class' => ActionColumn::class,
            'urlCreator' => function ($action, Horario $model, $key, $index, $column) {
                
                return Url::toRoute([$action, 'id' => $model->id]);
                }
                ,
            'visibleButtons'=>[                    
                'view' => false
            ]
            ],
        ],
    ]); ?>


</div>
