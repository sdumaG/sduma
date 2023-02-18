<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var  $form */
/* @var $id */

use yii\bootstrap5\Html;
?>


<div class="agua-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Datos de predial',) ?></h5> 

    <?= $form->field($modelSolicitudGenerica,"numeroPredial",['options' => ['class' => 'col-md-3'],])
    ->label("Número de predial")
    ?>

    <?= $form->field($modelSolicitudGenerica,"fechaPagoPredial",['options' => ['class' => 'col-md-3'],])
        //datetime
        ->textInput(["type"=>"date" /* ,"value"=>date("d/m/Y" ,  strtotime( $model->finActividad)) */  ])

        ->label("Fecha de pago de predial")
        ?>

</div>