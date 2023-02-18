<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Secretaría de Desarrollo Urbano y Medio Ambiente</h1>
            <p class="fs-5 fw-light">
                <?php 
                if (Yii::$app->user->isGuest){
                    echo "Gracias por usar el portal de ".   Yii::$app->name   .", inicie sesión o registese para iniciar algún trámite.";
                }
                else{
                    echo "Haga click en el menú 'Solicitudes' en la parte superior de la pantalla para listar las solicitudes existentes.";
                    echo "<br>";
                    echo "O menú 'Expedientes' para listar las solicitudes aprobadas.";
                }
                ?>

            </p>
              
        </div>
    </div>

    
</div>
