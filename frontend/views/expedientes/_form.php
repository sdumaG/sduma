<?php

use common\models\Expediente;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="expediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container">
        <input type="hidden" name="id" value="<?=$model->id?>" />
        <div class="  row ">
            <p class="col-5">
                <?= $form->field($model, 'estado')
                ->dropDownList(Expediente::STATUS_EXPEDIENTE);
                 ?>

            </p>
            <?php if( count( Expediente::STATUS_EXPEDIENTE /* $availableStates */) > 1 )  ?> <!-- Significa que la sesión es de un empleado, por tanto puede editar -->

            <p class="col-3">
                <?= Html::submitButton("Cambiar estado de solicitud",["class"=>"btn btn-success "])  ?> 
            </p>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
