<?php 
/** @var common\models\Escritura $modelEscritura */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div id='<?= $idContainer  ?>' class="escritura-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Datos de Escritura') ?></h5>       
    <?= $form->field($modelEscritura, 'noEscritura',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelEscritura, 'noRegistro',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelEscritura, 'noTomo',['options' => ['class' => 'col-md-4']])?>

</div>

