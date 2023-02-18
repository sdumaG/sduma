<?php 
/** @var common\models\Domicilio $domicilio */
/** @var  $form */
/** @var  $$tipoDomicilio */
/** @var  $showCallesColindantes , */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div class ="row g3 border rounded-3  p-3  ">

    <h5><?= Html::encode($tipoDomicilio) ?></h5>       

    <?= $form->field($domicilio, "[$id]calle",['options' => ['class' => 'col-md-6']])->textInput( /* [ 'name'=>"uwu" ] */) ?>
    
    <?= $form->field($domicilio, "[$id]coloniaFraccBarrio", ['options' => ['class' => 'col-md-6']])->textInput() ?>
    
    <?= $form->field($domicilio, "[$id]numExt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]numInt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$id]cp",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?php if($showCallesColindantes == true) {?>
    
        <?= $form->field($domicilio, "[$id]calleNorte", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($domicilio, "[$id]calleSur", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($domicilio, "[$id]calleOriente", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($domicilio, "[$id]callePoniente", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
        
    <?php } ?>
    
    <?= $form 
        ->field( $domicilio, "[$id]id", ['options' => ['class' => 'col-md-1', 'display' => 'none'],] ) 
        ->hiddenInput() ->label(false) 
    ?>
</div>
