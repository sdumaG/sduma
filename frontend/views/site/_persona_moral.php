<?php 
/** @var common\models\PersonaMoral $personaMoral */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div id='<?= $idContainer  ?>' class="persona-moral row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Persona moral') ?></h5>       

    <?= $form->field($personaMoral, 'rfc',['options' => ['class' => 'col-md-5']]) ?>
    <?= $form->field($personaMoral, 'denominacion',['options' => ['class' => 'col-md-5']]) ?>

</div>