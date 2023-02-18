<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
/* use kartik\datetime\DateTimePicker; */
/* use kartik\time\TimePicker; */

/** @var yii\web\View $this */
/** @var common\models\Horario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="horario-form">
 
    <?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <?= $form->field($model, 'inicioActividad',["options"=>["class"=>"col-5" ]] ) /* cambiar por textboxes alv */
            ->textInput(["type"=>"time","value"=>date("H:i" ,  strtotime( $model->inicioActividad)) ])/* No usar segundos, da un error de validación xd, minutos es suficiente */
            ->label("Inicio Actividad")
        ?>
        <?= $form->field($model, 'finActividad',["options"=>["class"=>"col-5"]]) /* cambiar por textboxes alv */
            ->textInput(["type"=>"time","value"=>date("H:i" ,  strtotime( $model->finActividad)) ])
            ->label("Fin Actividad")
        ?>

    </div>
  
 
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
