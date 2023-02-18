<?php

use common\models\SolicitudConstruccion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Solicitud Construccions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-construccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Solicitud Construccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'superficieTotal',
            'superficiePorConstruir',
            'superficiePreexistente',
            'niveles',
            //'cajones',
            //'COS',
            //'CUS',
            //'RPP',
            //'tomo',
            //'folioElec',
            //'cuentaCatastral',
            //'fechaCreacion',
            //'fechaModificacion',
            //'isDeleted',
            //'id_Persona_CreadoPor',
            //'id_Persona_ModificadoPor',
            //'id_Persona_DomicilioNotificaciones',
            //'id_DomicilioPredio',
            //'id_MotivoConstruccion',
            //'id_Contacto',
            //'id_TipoPredio',
            //'id_TipoConstruccion',
            //'id_GeneroConstruccion',
            //'id_SubGeneroConstruccion',
            //'id_DirectorResponsableObra',
            //'id_CorrSeguridadEstruc',
            //'id_Expediente',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SolicitudConstruccion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
