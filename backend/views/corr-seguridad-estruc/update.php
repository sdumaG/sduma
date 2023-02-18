<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CorrSeguridadEstruc $model */

$this->title = 'Actualizar Corr. Seguridad Estructural: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Corr Seguridad Estrucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="corr-seguridad-estruc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
