<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TipoPredio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tipo-predio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,"isActivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Registro activo")        
        ?>
        
    <div class="form-group">
        <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
