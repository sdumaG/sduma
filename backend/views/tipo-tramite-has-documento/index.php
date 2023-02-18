<?php

use common\models\TipoTramiteHasDocumento;
use common\models\WidgetStyleVic;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumentoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documentos por Tipo de trámite';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-tramite-has-documento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar documento a tipo de trámite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        /* 'filterModel' => $searchModel, */
        'pager' => WidgetStyleVic::PagerStyle(),
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Tipo de trámite',
             /* 'attribute' =>'id_TipoTramite' */
             'value'=> function($currTipoTramiteHasDocumento){
                return $currTipoTramiteHasDocumento->tipoTramite->nombre;
             }
            ],
            ['label'=>'Documento',
             /* 'attribute' =>'id_TipoTramite' */
             'value'=> function($currTipoTramiteHasDocumento){
                return $currTipoTramiteHasDocumento->documento->nombre;
             }
            ],
            /* 'id_TipoTramite',
            'id_Documento', */
            [
            'class' => ActionColumn::class,
            'urlCreator' => function ($action, TipoTramiteHasDocumento $model, $key, $index, $column) {
                
                if($action == 'view') return ;

                return Url::toRoute([$action, 'id_Documento' => $model->id_Documento, 'id_TipoTramite' => $model->id_TipoTramite]);
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
