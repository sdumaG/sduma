<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\GeneroConstruccion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="genero-construccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,"isActivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Registro activo")        
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
