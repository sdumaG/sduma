<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccion $model */

$this->title = 'Crear Subgenero Construcción';
$this->params['breadcrumbs'][] = ['label' => 'Sub Genero Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-genero-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
