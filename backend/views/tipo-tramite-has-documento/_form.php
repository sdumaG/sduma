<?php

use common\models\Documento;
use common\models\TipoTramite;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tipo-tramite-has-documento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
    $form->field($model, 'id_TipoTramite')
    ->dropDownList(
        $items = ArrayHelper::map(
            TipoTramite::findAll(["isActivo"=>1])
        , 'id','nombre'
        )

    )  
    ->label("Tipo Trámite") 
    ?>

   

    <?= $form->field($model, 'id_Documento')
    ->dropDownList(
        $items= ArrayHelper::map(
            Documento::findAll(["isActivo"=> 1]),
            'id',
            'nombre'
        )
    )
    ->label("Documento") ?>



   


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
