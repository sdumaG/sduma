<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoConstruccion $model */

$this->title = 'Create Tipo Construccion';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
