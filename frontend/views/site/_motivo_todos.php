<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var file $licenciaConstruccionAreaPreexistenteFile */
/** @var ffile $memoriaCalculoFile */
/** @var  $form */
use yii\bootstrap5\Html;
?>

<div class="row g3 p-3">

    <h6><?= Html::encode("Superficie por construir (metros cuadrados)") ?></h6>       
    <?= $form
    ->field($modelSolicitudGenerica, 'superficiePorConstruir',['options' => ['class' => 'col-md-4']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" , "min"=>"0",'onchange'=> 'superficiePorConstruirChange(event)']) 
    ?>
    <!-- SI es mayor a 250, memoria de cálculo-->

    <?= $form
    ->field($memoriaCalculoFile, '[memoriaCalculo]myFile',['options' => ['class' => 'col-md-4',"id"=>"inputFileMemoriaCalculo"]])
    ->fileInput([/* 'multiple' => true,  */'accept' => '.pdf,.jpeg,.jpg,.png']) 
    ->label("Memoria de cálculo (subir archivo)")        
    ?>
  </div>

  <div class="row g3 p-3">

    <?= $form
    ->field($modelSolicitudGenerica, 'areaPreExistente',['options' => ['class' => 'col-md-4']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" , "min"=>"0"]) 
    ?>
 
    <?= $form
        ->field($licenciaConstruccionAreaPreexistenteFile, '[licenciaConstruccionAreaPreexistente]myFile',['options' => ['class' => 'col-md-4',"id"=>"inputFileMemoriaCalculo"]])
        ->fileInput([/* 'multiple' => true,  */'accept' => '.pdf,.jpeg,.jpg,.png']) 
        ->label("Licencia de construcción de area preexistente (opcional)")
        ?>
    <script>	

        const inputFileMemoriaCalculo = document.getElementById("inputFileMemoriaCalculo");
        const inputFileMemoriaCalculoParent = inputFileMemoriaCalculo.parentElement;

        const superficiePorConstruirChange = function(event){
            //desbloquea memoria de calculo
            let source = event.target || event.srcElement;
            let inputSuperficiePorConstuir = source.value;
            hideShowSuperficiePorConstruirFileInput(inputSuperficiePorConstuir)
            
        }

        const hideShowSuperficiePorConstruirFileInput = function (superficiePorConstruirAmount){
            if(superficiePorConstruirAmount >= 250){

                inputFileMemoriaCalculoParent.append(inputFileMemoriaCalculo);

            }else{
                inputFileMemoriaCalculo.remove();
            }
        }
        hideShowSuperficiePorConstruirFileInput(<?=  $modelSolicitudGenerica->areaPreExistente  ?>);


    </script>

</div>
