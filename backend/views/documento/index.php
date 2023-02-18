<?php

use common\models\Documento;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\DocumentoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Documento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            /* 'isActivo', */
            [
                'label' => "Activo",                
                'value' => function($currExpediente){
                  return $currExpediente->isActivo?"Sí":"No";
                }
            ],
            [
                'label' => "Solo entrega física",                
                'value' => function($currExpediente){
                  return $currExpediente->isSoloEntregaFisica?"Sí":"No";
                }
            ],
            [
                'label' => "Subida multiple",                
                'value' => function($currExpediente){
                  return $currExpediente->hasMultipleArchivo?"Sí":"No";
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Documento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                } ,
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
