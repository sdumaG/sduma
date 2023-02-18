<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumento $model */

$this->title = 'Actualizar Documento por Tipo de trámite' /* . $model->id_Documento */;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Tramite Has Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_Documento, 'url' => ['view', 'id_Documento' => $model->id_Documento, 'id_TipoTramite' => $model->id_TipoTramite]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-tramite-has-documento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
