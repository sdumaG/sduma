<?php

use common\models\SubGeneroConstruccion;
use common\models\WidgetStyleVic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Subgenero de Construccion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-genero-construccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Subgenero de Construcción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => WidgetStyleVic::PagerStyle(),

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'udm',
            'tamanioLimiteInferior',
            'tamanioLimiteSuperior',
            'nombreTarifa',
            ['label' =>"Tarifa $" ,
             'value'=>'tarifa'
            ],
           // 'tarifa',
            //'fechaCreacion',
            'anioVigencia',
            /*  'isActivo', */
            [
            'label' => "Activo",                
            'value' => function($currExpediente){
                    return $currExpediente->isActivo?"Sí":"No";
                }
            ],
            //'id_GeneroConstruccion',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, SubGeneroConstruccion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
