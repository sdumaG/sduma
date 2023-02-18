<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoPredio $model */

$this->title = 'Actualizar Tipo Predio '/*  . $model->id */;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Predios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-predio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
