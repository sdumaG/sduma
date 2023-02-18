<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */

//$this->title = 'Relacionar documentos con Trámite, Motivo, Documento del ciudadano y Documento de la solicitud';
$this->title = 'Crear configuración de documentos';
$this->params['breadcrumbs'][] = ['label' => 'Configuración de documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-tramite-motivo-cuentacon-doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
