<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sub-genero-construccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'udm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanioLimiteInferior')->textInput() ?>

    <?= $form->field($model, 'tamanioLimiteSuperior')->textInput() ?>

    <?= $form->field($model, 'nombreTarifa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarifa')->textInput() ?>

    <?= $form->field($model, 'fechaCreacion')->textInput() ?>

    <?= $form->field($model, 'anioVigencia')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,"isActivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Registro activo")        
        ?>
        
    <?= $form->field($model, 'id_GeneroConstruccion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
