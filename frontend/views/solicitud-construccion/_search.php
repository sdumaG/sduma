<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="solicitud-construccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'superficieTotal') ?>

    <?= $form->field($model, 'superficiePorConstruir') ?>

    <?= $form->field($model, 'superficiePreexistente') ?>

    <?= $form->field($model, 'niveles') ?>

    <?php // echo $form->field($model, 'cajones') ?>

    <?php // echo $form->field($model, 'COS') ?>

    <?php // echo $form->field($model, 'CUS') ?>

    <?php // echo $form->field($model, 'RPP') ?>

    <?php // echo $form->field($model, 'tomo') ?>

    <?php // echo $form->field($model, 'folioElec') ?>

    <?php // echo $form->field($model, 'cuentaCatastral') ?>

    <?php // echo $form->field($model, 'fechaCreacion') ?>

    <?php // echo $form->field($model, 'fechaModificacion') ?>

    <?php // echo $form->field($model, 'isDeleted') ?>

    <?php // echo $form->field($model, 'id_Persona_CreadoPor') ?>

    <?php // echo $form->field($model, 'id_Persona_ModificadoPor') ?>

    <?php // echo $form->field($model, 'id_Persona_DomicilioNotificaciones') ?>

    <?php // echo $form->field($model, 'id_DomicilioPredio') ?>

    <?php // echo $form->field($model, 'id_MotivoConstruccion') ?>

    <?php // echo $form->field($model, 'id_Contacto') ?>

    <?php // echo $form->field($model, 'id_TipoPredio') ?>

    <?php // echo $form->field($model, 'id_TipoConstruccion') ?>

    <?php // echo $form->field($model, 'id_GeneroConstruccion') ?>

    <?php // echo $form->field($model, 'id_SubGeneroConstruccion') ?>

    <?php // echo $form->field($model, 'id_DirectorResponsableObra') ?>

    <?php // echo $form->field($model, 'id_CorrSeguridadEstruc') ?>

    <?php // echo $form->field($model, 'id_Expediente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
