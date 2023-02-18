<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumento $model */

$this->title = 'Documentos por Tipo de trámite';
$this->params['breadcrumbs'][] = ['label' => 'Documentos por Tipo de trámite', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-tramite-has-documento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
