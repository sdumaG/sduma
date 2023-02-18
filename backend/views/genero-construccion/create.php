<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GeneroConstruccion $model */

$this->title = 'Crear Genero de Construcción';
$this->params['breadcrumbs'][] = ['label' => 'Genero Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
