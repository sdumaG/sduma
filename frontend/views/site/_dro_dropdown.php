<?php 
/** @var common\models\ $[] */
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var common\models\DirectorResponsableObra $modelDROList */
/** @var  $form */

/**  @var $attributeNameDRO Indica que FK de DRO se va a renderizar*/
/**  @var $idContainer Id para el container padre, para que JS si necesita, remueva y/añada ese elemento del dom*/



use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

?>

<?= $form
        ->field($modelSolicitudGenerica, $attributeNameDRO /* model attribute  */, [
            'options' => ArrayHelper::merge(
                    ['class' => 'col-md-3'],
                    !$idContainer ? [] : ["id" => $idContainer]
                ) 
        ])
        ->dropDownList(
          $items =  ArrayHelper::merge(
            ["-1"=>"Seleccione"],                        
            ArrayHelper::map(
                $modelDROList,
                'id' ,
                function ($currentDRO) {
                    return 
                        $currentDRO->abreviacion . " " .
                        $currentDRO->persona->apellidoP . " " . 
                        $currentDRO->persona->apellidoM . " " .
                        $currentDRO->persona->nombre . " - ". 
                        $currentDRO->cedula . " "
                    ; /* .'-'.$currentDRO['seconde parameter']; */
                }
            )
          )
        )
        ->label('Director Responsable de Obra') ?>
        <!-- 

<div class="persona-fisica row g3  border rounded-3  p-3 ">
    <h5><  Html::encode('Director Responsable de Obra') ?></h5>       
    <  $form->field($modelPersonaDRO, '[DRO]nombre',['options' => ['class' => 'col-md-8']])?>
    <  $form->field($modelPersonaDRO, '[DRO]apellidoP',['options' => ['class' => 'col-md-5']])?>
    <  $form->field($modelPersonaDRO, '[DRO]apellidoM',['options' => ['class' => 'col-md-5']])?>
    
    <  $form
        ->field($modelDRO, 'cedula',['options' => ['class' => 'col-md-5']])
        ->label("Registro")
    ?>

</div> -->