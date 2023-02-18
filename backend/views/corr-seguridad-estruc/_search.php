<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CorrSeguridadEstrucSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="corr-seguridad-estruc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'abreviacion') ?>

    <?= $form->field($model, 'cedula') ?>

    <?= $form->field($model, 'isActivo') ?>

    <?php // echo $form->field($model, 'id_Persona') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
