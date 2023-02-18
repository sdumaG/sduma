<?php 
/** @var common\models\Persona $modelPropietarios[] */

/** @var  $form */
/* @var $id */

use yii\bootstrap5\Html;
?>

<div class="Propietarios-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Propietario(s)',) ?></h5> 
    <div>
        <?= Html::label("Cantidad de Propietarios","noPropietarios",["class"=>"form-label"])  ?>
        <?= Html::input("number","noPropietarios",count($modelPropietarios), ['class' => 'col-md-1 form-control',"step"=>"1","min" => 1,"onchange"=>"this.form.submit()"])  ?>
    </div>
    <br>
    <br>
    <?php foreach ($modelPropietarios as $id => $currPropietario) { ?>
        <h6>Propietario <?= Html::encode($id)  ?></h6>
        <?= $form->field($currPropietario, "[propietario$id]nombre",['options' => ['class' => 'col-md-4']])?>
        <?= $form->field($currPropietario, "[propietario$id]apellidoP",['options' => ['class' => 'col-md-4']])?>
        <?= $form->field($currPropietario, "[propietario$id]apellidoM",['options' => ['class' => 'col-md-4']])?>
        <br>
    <?php }  ?> 
    

</div>