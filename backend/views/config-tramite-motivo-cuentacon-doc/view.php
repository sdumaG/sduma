<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */

$this->title = $model->id_Documento;
$this->params['breadcrumbs'][] = ['label' => 'Config Tramite Motivo Cuentacon Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="config-tramite-motivo-cuentacon-doc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_TipoTramite',
            'id_MotivoConstruccion',
            'id_SolicitudGenericaCuentaCon',
            'id_Documento',
        ],
    ]) ?>

</div>
