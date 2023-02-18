<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccion $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solicitud-construccion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de querer eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'superficieTotal',
            'superficiePorConstruir',
            'superficiePreexistente',
            'niveles',
            'cajones',
            'COS',
            'CUS',
            'RPP',
            'tomo',
            'folioElec',
            'cuentaCatastral',
            'fechaCreacion',
            'fechaModificacion',
            'isDeleted',
            'id_Persona_CreadoPor',
            'id_Persona_ModificadoPor',
            'id_Persona_DomicilioNotificaciones',
            'id_DomicilioPredio',
            'id_MotivoConstruccion',
            'id_Contacto',
            'id_TipoPredio',
            'id_TipoConstruccion',
            'id_GeneroConstruccion',
            'id_SubGeneroConstruccion',
            'id_DirectorResponsableObra',
            'id_CorrSeguridadEstruc',
            'id_Expediente',
        ],
    ]) ?>

</div>
