<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DirectorResponsableObra $model */

$this->title = 'Actualizar Director Responsable Obra: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Director Responsable Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="director-responsable-obra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
