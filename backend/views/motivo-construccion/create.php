<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MotivoConstruccion $model */

$this->title = 'Crear Motivo Construcción';
$this->params['breadcrumbs'][] = ['label' => 'Motivo Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motivo-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
