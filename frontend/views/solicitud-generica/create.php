<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenerica $model */

$this->title = 'Create Solicitud Generica';
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Genericas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-generica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
