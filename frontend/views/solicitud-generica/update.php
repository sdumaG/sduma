<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenerica $model */

$this->title = 'Update Solicitud Generica: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Genericas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-generica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
