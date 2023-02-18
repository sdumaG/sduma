<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoPredio $model */

$this->title = 'Crear Tipo Predio';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Predios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-predio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
