<?php 
/** @var common\models\Domicilio $domicilio */
/** @var  $form */
/* @var $id */

?>

<div class ="row g3">
    
    <?= $form->field($domicilio, "[$id]calle",['options' => ['class' => 'col-md-6']])->textInput( /* [ 'name'=>"uwu" ] */) ?>
    
    <?= $form->field($domicilio, "[$id]coloniaFraccBarrio", ['options' => ['class' => 'col-md-6']])->textInput() ?>
    
    <?= $form->field($domicilio, "[$id]numExt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]numInt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]cp",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]entreCallesH", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]entreCallesV", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

</div>
