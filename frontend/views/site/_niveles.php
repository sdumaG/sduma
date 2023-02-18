<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var file $mecanicaSuelosFile */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div class="niveles-fields row g3  p-3 ">
        
    <?= $form
        ->field($modelSolicitudGenerica, 'niveles', [
            'options' => 
            [
                'class' => 'col-md-4'        
                ,'onchange'=> 'nivelesChange(event)'
            ]
        ])
        ->textInput(['type' => 'number',"min"=>1]) ?>


    <?= $form
    ->field($mecanicaSuelosFile, '[mecanicaSuelos]myFile',['options' => ['class' => 'col-md-4',"id"=>"inputFilemecanicaSuelos",/* "style"=>"display:none" */]])
    ->fileInput([/* 'multiple' => true,  */'accept' => '.pdf,.jpeg,.jpg,.png']) 
    ->label("Mecánica de suelos (subir archivo)")        
    ?>
  
    <script>
        const inputFilemecanicaSuelos = document.getElementById("inputFilemecanicaSuelos");
        const inputFileMecanicaSuelosParent = inputFilemecanicaSuelos.parentElement;
        const nivelesChange = function(event){
            //desbloquea FIRMA DRO
            let source = event.target || event.srcElement;
            let nivelesInput = source.value;
            nivelesHideListener(nivelesInput);
           
        }

        const nivelesHideListener = function(nivelesInput){
            if(nivelesInput >= 3){
                inputFileMecanicaSuelosParent.append(inputFilemecanicaSuelos);
                //inputFilemecanicaSuelos.style.display = "block";
            }
            else{
                //inputFilemecanicaSuelos.style.display = "none"; //Problemas al enviar formulario, porque corre la validación aun cuando este hidden.
                //inputFileMecanicaSuelosParent.removeChild(inputFilemecanicaSuelos);///no usar removeChild (si ya fue removido dará error, no pasa nada, pero mejor evitarlo)
                //inputFileMecanicaSuelosParent.innerHTML = ""; //tampoco usar, eliminará tambien el field del numero de niveles
                inputFilemecanicaSuelos.remove();
            }
        }
        
        nivelesHideListener(<?= $modelSolicitudGenerica->niveles ?>);        

    </script>
</div>
