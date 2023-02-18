<?php

use common\models\TipoTramite;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tipo Trámite ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-tramite-index">

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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TipoTramite $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
                ,
                'visibleButtons'=>[
                    /* 'view'=> function($model){
                          return $model->status!=1; //puede aparecer o no, segun el estado del modelo :0 awesome xd
                    }, */
                    'view' => false
                ]        
            ],
        ],
    ]); ?>


</div>
