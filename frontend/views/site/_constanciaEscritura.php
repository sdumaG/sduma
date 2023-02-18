<?php 
/** @var common\models\ConstanciaEscritura $modelConstanciaEscritura */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div id='<?= $idContainer  ?>' class="constancia-escritura-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Datos de Constancia de Escritura') ?></h5>       
    <?= $form->field($modelConstanciaEscritura, 'noEscritura',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelConstanciaEscritura, 'noNotaria',['options' => ['class' => 'col-md-4']])?>
    <?= $form
    ->field($modelConstanciaEscritura, 'fechaEmision',['options' => ['class' => 'col-md-4']])
    ->textInput(["type"=>"date"])

    ?>

</div>

