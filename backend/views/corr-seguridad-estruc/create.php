<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CorrSeguridadEstruc $model */

$this->title = 'Crear Corresponsal Seguridad Estructural';
$this->params['breadcrumbs'][] = ['label' => 'Corr Seguridad Estrucs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corr-seguridad-estruc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
