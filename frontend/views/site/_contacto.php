<?php 
/** @var common\models\Contacto $modelContacto */
/** @var  $form */
use yii\bootstrap5\Html;
?>

<div class="contacto-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Contacto') ?></h5>       
    <?= $form->field($modelContacto, 'email',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelContacto, 'telefono',['options' => ['class' => 'col-md-4']])?>       
</div>