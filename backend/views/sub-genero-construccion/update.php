<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccion $model */

$this->title = 'Actualizar Sub Género Construcción: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Género Construccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-genero-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
