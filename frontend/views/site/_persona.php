<?php 
/** @var common\models\Persona $persona */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div id='<?= $idContainer  ?>' class="persona-fisica row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Persona física') ?></h5>       
    <?= $form->field($persona, '[personaF]nombre',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($persona, '[personaF]apellidoP',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($persona, '[personaF]apellidoM',['options' => ['class' => 'col-md-4']])?>

</div>