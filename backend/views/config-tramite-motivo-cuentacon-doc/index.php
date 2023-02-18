<?php

use common\models\ConfigTramiteMotivoCuentaconDoc;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\WidgetStyleVic;


/** @var yii\web\View $this */
/** @var common\ConfigTramiteMotivoCuentaconDocSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Configuración de documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-tramite-motivo-cuentacon-doc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear configuración de documentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => WidgetStyleVic::PagerStyle(),
        /* 'filterModel' => $searchModel, */
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_TipoTramite',
            //'id_MotivoConstruccion',
            //'id_SolicitudGenericaCuentaCon',
           // 'id_Documento',

           ['label'=>'Tipo de trámite',
            'value'=> function($currConfigTramiteMotivoCuentaconDocSearch){
               return $currConfigTramiteMotivoCuentaconDocSearch->tipoTramite->nombre;
            }
           ],
           ['label'=>'Motivo de Construcción',
            'value'=> function($currConfigTramiteMotivoCuentaconDocSearch){
                return $currConfigTramiteMotivoCuentaconDocSearch->motivoConstruccion->nombre;
            }
            ],
            ['label'=>'Cuenta con',
            'value'=> function($currConfigTramiteMotivoCuentaconDocSearch){
                return $currConfigTramiteMotivoCuentaconDocSearch->solicitudGenericaCuentaCon->nombre;
            }
            ],
           ['label'=>'Documento',
            'value'=> function($currConfigTramiteMotivoCuentaconDocSearch){
               return $currConfigTramiteMotivoCuentaconDocSearch->documento->nombre;
            }
           ],



            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ConfigTramiteMotivoCuentaconDoc $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite]);
                 }
            ],
        ],
    ]); ?>


</div>
