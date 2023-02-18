<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\DirectorResponsableObra $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="director-responsable-obra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abreviacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model,"isActivo")->dropDownList(
                $items = [0=>"No", 1 => "Sí"]
        )->label("Registro activo")        
        ?>
        
    <?= $form->field($model, 'id_Persona')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
