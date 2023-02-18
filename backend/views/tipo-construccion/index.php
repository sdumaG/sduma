<?php

use common\models\TipoConstruccion;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TipoConstruccionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tipo de Construcción';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-construccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear '.$this->title, ['create'], ['class' => 'btn btn-success']) ?>
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
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, TipoConstruccion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'visibleButtons'=>[                    
                    'view' => false
                ]
            ],
        ],
    ]); ?>


</div>
