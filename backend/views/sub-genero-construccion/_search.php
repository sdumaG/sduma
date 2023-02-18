<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sub-genero-construccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'udm') ?>

    <?= $form->field($model, 'tamanioLimiteInferior') ?>

    <?= $form->field($model, 'tamanioLimiteSuperior') ?>

    <?php // echo $form->field($model, 'nombreTarifa') ?>

    <?php // echo $form->field($model, 'tarifa') ?>

    <?php // echo $form->field($model, 'fechaCreacion') ?>

    <?php // echo $form->field($model, 'anioVigencia') ?>

    <?php // echo $form->field($model, 'isActivo') ?>

    <?php // echo $form->field($model, 'id_GeneroConstruccion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
