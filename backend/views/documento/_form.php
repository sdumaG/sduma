<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Documento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,"isActivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Registro activo")        
        ?>
    <?=$form->field($model,"isSoloEntregaFisica")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Entrega física únicamente")        
        ?>
    <?=$form->field($model,"hasMultipleArchivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Subida múltiple")        
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
