<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccion $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Genero Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sub-genero-construccion-view">

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
            'nombre',
            'udm',
            'tamanioLimiteInferior',
            'tamanioLimiteSuperior',
            'nombreTarifa',
            'tarifa',
            'fechaCreacion',
            'anioVigencia',
            'isActivo',
            'id_GeneroConstruccion',
        ],
    ]) ?>

</div>
