<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\ConfigTramiteMotivoCuentaconDocSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="config-tramite-motivo-cuentacon-doc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_TipoTramite') ?>

    <?= $form->field($model, 'id_MotivoConstruccion') ?>

    <?= $form->field($model, 'id_SolicitudGenericaCuentaCon') ?>

    <?= $form->field($model, 'id_Documento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
