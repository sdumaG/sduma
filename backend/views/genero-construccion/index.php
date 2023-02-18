<?php

use common\models\GeneroConstruccion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\GeneroConstruccionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Genero Construccion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-construccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Género Construccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
           /*  'isActivo', */
           [
            'label' => "Activo",                
            'value' => function($currExpediente){
                return $currExpediente->isActivo?"Sí":"No";
            }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GeneroConstruccion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'visibleButtons'=>[                    
                    'view' => false
                ]
            ],
        ],
    ]); ?>


</div>
