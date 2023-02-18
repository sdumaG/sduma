<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var  $form */
/* @var $id */
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
?>


<div class="agua-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Datos de recibo de agua',) ?></h5> 

    <?= $form->field($modelSolicitudGenerica,"tipoTomaAgua",['options' => ['class' => 'col-md-3'],])
    ->label("Tipo de toma de agua")
    ?>
    <?= $form->field($modelSolicitudGenerica,"numeroTomaAgua",['options' => ['class' => 'col-md-3'],])
    ->label("Número de toma de agua")
    ?>
    <?= $form->field($modelSolicitudGenerica,"numeroReciboAgua",['options' => ['class' => 'col-md-3'],])
    ->label("Número de recibo de agua")
    ?>
    <!--  (si entrega recibo) -->

<!-- SOLAMENTE SI ES EJIDAL, PODRÄ ELEJIR ENTRE CONTRATO O RECIBO -->
    <?= $form
        ->field($modelSolicitudGenerica, 'subeRecibo', [
            'options' => ['class' => 'col-md-2'],])
        ->dropDownList(
        
            ArrayHelper::merge(
                
                /* $modelSolicitudGenerica->id_SolicitudGenericaCuentaCon ==3?
                    [ "0"=>"Contrato de agua",]: */ []
                    ,       
                ["1" => "Recibo de agua"]
            )
        )
        ->label('Cuenta con') 
        ?>

    <?= $form->field($modelSolicitudGenerica,"fechaPagoAguaOContrato",['options' => ['class' => 'col-md-3'],])
    //datetime

    ->textInput(["type"=>"date" /* ,"value"=>date("d/m/Y" ,  strtotime( $model->finActividad)) */  ])

    ->label("Fecha pago de recibo")
    ?>
    <!--  o contrato de agua -->






</div>