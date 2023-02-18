<?php 

use yii\bootstrap5\Html;
use common\models\Documento;
use yii\helpers\Url;
/** @var yii\web\View $this */

/* 
* $expediente common\models\Expediente
* $solicitudConstruccion common\models\SolicitudConstruccion
* $soliHasDocuments common\models\SolicitudConstruccionHasDocumento  
*/
/** @var common\models\Expediente $expedienteAImprimir  */


frontend\assets\AppAsset::register($this);

$css1 = file_get_contents("sheets-of-paper-a4.css");
$css2 = file_get_contents("sheets-of-paper.css");
$css3 = file_get_contents("bootstrap.min.css");
$cssVic = file_get_contents("vic.css");

/* 
$css1 = file_get_contents("/../../web/css/sheets-of-paper-a4.css");
$css2 = file_get_contents("/../../web/css/sheets-of-paper.css"); */

$this->registerCss($css2);
$this->registerCss($css1);
$this->registerCss($css3);
$this->registerCss($cssVic);
$meses = array(1=>"ENERO", "FEBRERO", "MARZO", "ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

?> 


<?php $this->beginPage() ?>


<!DOCTYPE html>
<!--
 * HTML-Sheets-of-Paper (https://github.com/delight-im/HTML-Sheets-of-Paper)
 * Copyright (c) delight.im (https://www.delight.im/)
 * Licensed under the MIT License (https://opensource.org/licenses/MIT)
-->
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Emulating real sheets of paper in web documents (using HTML and CSS)">
        
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>

	</head>
	<body class="document">
    <?php $this->beginBody() ?>

		<div class="page text-uppercase" contenteditable="false">
			
            <div class="row flex-nowrap justify-content-between align-content-center align-items-center  p-0  mw-900">                    
                <?php 
                    $img = Url:: to('@web/images/logourupan.png')  ;                 
                    echo Html::img($img , ['class' => 'col-1 p-0'/* 'pull-left img-responsive' */]);  
                ?> 

                <div class="d-flex flex-column align-items-center col-10  ">

                    <div class="title-secretary-note fw-lighter">H. AYUNTAMIENTO CONSTITUCIONAL DE URUAPAN 2021-2024</div>
                    <div class="title-secretary fw-bolder">SECRETARÍA DE DESARROLLO URBANO Y MEDIO AMBIENTE</div>
                    <div class="title-secretary-secondary fw-normal">DIRECCIÓN DE DESARROLLO URBANO</div>
                    <div class="title-secretary-third fw-normal">DEPARTAMENTO DE EDIFICACIÓN</div>
                </div>

                <?php 
                    $img = Url:: to('@web/images/logourupan.png')  ;                 
                    echo Html::img($img , ['class' => 'col-1 p-0'/* 'pull-left img-responsive' */]);
                ?> 
            </div>    
            <div class="row flex-wrap justify-content-evenly align-content-center align-items-center  p-0  mw-900">                    

				<div class="col m-b-1">

					<div class="outlined-box d-flex justify-content-between d-inline p-1">
						<div class="box-tittle">FOLIO:</div>
						<div class="box-value">C.0524/2022</div>
					</div>

					<div class="outlined-box d-flex mt-2  justify-content-between d-inline p-1">
						<div class="box-tittle">CLAVE:</div>
						<div class="box-value">(P) ORDINARIO</div>
					</div>
				</div>

				<div class="col ">
					<div class="outlined-box d-flex justify-content-between d-inline p-1">
						<div class="box-tittle">EXP:</div>
						<div class="box-value">SDUMA <?=$expedienteAImprimir->idAnual."/".$expedienteAImprimir->anio  ?> </div>
					</div>


					<div class="outlined-box mt-2 d-flex justify-content-between d-inline p-1">
						<div class="box-tittle">FECHA:</div>
						<div class="box-value text-uppercase"><?= date("d")." DE ".$meses[date("n")]." DEL ".date("Y")  ?> </div>
					</div>					
				</div>				

            </div>    

			<div class="border border-dark  d-flex p-1 mt-2 mb-2  fs-3 fw-bolder justify-content-center d-inline ">
				<?php echo $expedienteAImprimir->solicitudGenerica->motivoConstruccion->nombre  ?>  DE CONSTRUCCIÓN
			</div>

			<div class="border border-dark  d-flex p-1 mt-2 mb-2  fs-3 justify-content-center d-inline ">
				<div class="col-2   title-secretary-third ">GÉNERO</div>
				<div class="col-8  title-secretary-secondary fw-bolder"><?php echo $expedienteAImprimir->solicitudGenerica->generoConstruccion->nombre  ?> </div>
				
			</div>
			<div class="border border-dark  d-flex p-1 mt-2 mb-2  fs-3 justify-content-center d-inline ">
				<div class="col-2   title-secretary-third ">TIPO</div>
				<div class="col-8  title-secretary-secondary "><?php echo $expedienteAImprimir->solicitudGenerica->niveles  ?> NIVELES </div>				
			</div>

			<!-- SE OTORGA  -->
			<div class="border border-dark container-xl p-1 mt-2 mb-2  fs-3   ">
				<div class="row">
					<div class="col  title-secretary-third ">SE OTORGA A</div>
					<div class="col  title-secretary-secondary ">
						<?php echo $expedienteAImprimir->solicitudGenerica->id_PersonaFisica ?
							$expedienteAImprimir->solicitudGenerica->personaFisica->nombre." ".
							$expedienteAImprimir->solicitudGenerica->personaFisica->apellidoP. " ".
							$expedienteAImprimir->solicitudGenerica->personaFisica->apellidoM
							:
							$expedienteAImprimir->solicitudGenerica->personaMoral->denominacion
							;
						?>  
					</div>	
				</div>
				<div class="row">
					<div class="col  title-secretary-third ">DOMICILIO PARA RECIBIR NOTIFICACIONES</div>
					<div class="col  title-secretary-secondary ">
						<?php echo 
							$expedienteAImprimir->solicitudGenerica->domicilioNotificaciones->calle." No. ".
							$expedienteAImprimir->solicitudGenerica->domicilioNotificaciones->numExt. " ".

							(
							$expedienteAImprimir->solicitudGenerica->domicilioNotificaciones->numInt
							?
								( " Int. ".$expedienteAImprimir->solicitudGenerica->domicilioNotificaciones->numInt)
							:""
							);						
							 
						?>  
					</div>		
				</div>
				<div class="row">
					<div class="col  title-secretary-third ">COL / FRACC / CONJ HAB / BARRIO</div>
					<div class="col  title-secretary-secondary ">
						<?php echo $expedienteAImprimir->solicitudGenerica->domicilioNotificaciones->coloniaFraccBarrio;									
						?>  
					</div>		
				</div>

							
			</div>


			<!-- PREDIO  -->
			<div class="border border-dark container-xl p-1 mt-2 mb-2  fs-3   ">			
				<div class="row">
					<div class="col  title-secretary-third ">OBRA UBICADA EN LA CALLE</div>
					<div class="col  title-secretary-secondary ">
						<?php echo 
							$expedienteAImprimir->solicitudGenerica->domicilioPredio->calle." No. ".
							$expedienteAImprimir->solicitudGenerica->domicilioPredio->numExt. " ".

							(
							$expedienteAImprimir->solicitudGenerica->domicilioPredio->numInt
							?
								( " Int. ".$expedienteAImprimir->solicitudGenerica->domicilioPredio->numInt)
							:""
							);						
							 
						?>  
					</div>		
				</div>
				
							<!-- entre calles ciclo -->
					<div class="row">
						<div class="col  title-secretary-third ">Entre calles</div>
					</div>
					
					
					<div class="row">
						<div class="col  title-secretary-third "> CALLE NORTE</div>
						<div class="col  title-secretary-secondary ">
							<?php echo $expedienteAImprimir->solicitudGenerica->domicilioPredio->calleNorte;?>  
							
						</div>		
					</div>
					<div class="row">
						<div class="col  title-secretary-third "> CALLE SUR</div>
						<div class="col  title-secretary-secondary ">
							<?php echo $expedienteAImprimir->solicitudGenerica->domicilioPredio->calleSur;?>  
							
						</div>		
					</div>
					<div class="row">
						<div class="col  title-secretary-third "> CALLE Poniente</div>
						<div class="col  title-secretary-secondary ">
							<?php echo $expedienteAImprimir->solicitudGenerica->domicilioPredio->callePoniente;?>  
							
						</div>		
					</div>
					<div class="row">
						<div class="col  title-secretary-third "> CALLE Oriente</div>
						<div class="col  title-secretary-secondary ">
							<?php echo $expedienteAImprimir->solicitudGenerica->domicilioPredio->calleOriente;?>  
							
						</div>		
					</div>
					
					<br>

					<?php if($expedienteAImprimir->solicitudGenerica->id_Escritura !=null){  ?> 

						<div class="row">
							<div class="col  title-secretary-third "> Titulo de la propiedad</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->escritura->noEscritura;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> Registro público de la propiedad</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->escritura->noRegistro;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> Tomo</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->escritura->noTomo;?>  								
							</div>		
						</div>

					<?php } elseif ($expedienteAImprimir->solicitudGenerica->id_ConstanciaEscritura !=null){  ?> 
																			$noEscritura
																			$noNotaria
																			 $fechaEmision
						<div class="row">
							<div class="col  title-secretary-third "> Titulo de la propiedad</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->constanciaEscritura->noEscritura;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> Notaría</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->constanciaEscritura->noNotaria;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> fecha emisión</div>
							<div class="col  title-secretary-secondary ">
								<?php echo date("d/m/Y", strtotime($expedienteAImprimir->solicitudGenerica->constanciaEscritura->fechaEmision));?>	
							</div>		
						</div>

					<?php   }else{?>

						<div class="row">
							<div class="col  title-secretary-third "> Constancia ejidal</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->constanciaPosecionEjidal->noConstanciaPosEjidal;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> Constancia ejidal emitida por</div>
							<div class="col  title-secretary-secondary ">
								<?php echo $expedienteAImprimir->solicitudGenerica->constanciaPosecionEjidal->nombreQuienEmitio;?>  								
							</div>		
						</div>
						<div class="row">
							<div class="col  title-secretary-third "> fecha emisión</div>
							<div class="col  title-secretary-secondary ">
								<?php echo date("d/m/Y", strtotime($expedienteAImprimir->solicitudGenerica->constanciaPosecionEjidal->fechaEmision));?>	
							</div>		
						</div>


					<?php  } ?> 
						<!-- FIN CUENTA CON -->

					<div class="row">
						<div class="col  title-secretary-third "> CUENTA PREDIAL</div>
						<div class="col  title-secretary-secondary ">
							<?php echo date("d/m/Y", strtotime($expedienteAImprimir->solicitudGenerica->numeroPredial));?>	
						</div>		
					</div>
					<div class="row">
						<div class="col  title-secretary-third "> TOMA C.A.P.A.S.U.</div>
						<div class="col  title-secretary-secondary ">
							<?php echo $expedienteAImprimir->solicitudGenerica->numeroTomaAgua;?>	
						</div>		
					</div>
					<div class="row">
						<div class="col  title-secretary-third "> DIRECTOR RESPONSABLE DE OBRA</div>
						<div class="col  title-secretary-secondary ">
							<?php echo 
								$expedienteAImprimir->solicitudGenerica->directorResponsableObra->abreviacion." ".
								$expedienteAImprimir->solicitudGenerica->directorResponsableObra->persona ->nombre." ".
								$expedienteAImprimir->solicitudGenerica->directorResponsableObra->persona->apellidoP." ".
								$expedienteAImprimir->solicitudGenerica->directorResponsableObra->persona->apellidoM;							
							?>	
						</div>		
					</div>



							
			</div>

			<div class="border border-dark container-xl p-1 mt-2 mb-2  fs-3   ">
				<div class="row">
					<div class="col  title-secretary-third ">SUPERFICIE A CONSTRUIR EN M2</div>
					<div class="col  title-secretary-secondary ">
						<?php echo $expedienteAImprimir->solicitudGenerica->superficiePorConstruir							 
						?>  
					</div>	
				</div>
			</div>

			<div class="border border-dark container-xl p-1 mt-2 mb-2  ">
				<div class="row justify-content-evenly">
					<div class="col-3 d-flex border border-dark col-6 title-secretary-third justify-content-center flex-wrap align-items-center align-content-center">
						<div class=" fw-bolder" >
							LIC. ANASTACION CUEVAS LÓPEZ
						</div>
						<div>
							DIRECCIÓN DE DESARROLLO URBANO
						</div>
					</div>
					<div class="col-5">
						<div class="row title-secretary-note-two fw-bolder  "><!-- lead text-lowercase -->
							En términos de lo dispuesto en el Articulo 444 del Reglamento de Construcción para el Municipio de Uruapan, 
							Michoacán vigente, el propietario de la obra es responsable de su situación físcal, incluyendo
							en éstas la observación de las disposiciones de la Ley del seguro Social y del reglamento del 
							seguro social obligatorio para los trabajadores de la Construcción por Obra o Tiempo Determinado, 
							publicado en el Diario Oficial de la Federación el viernes 22 de Noviembre de 1983. NOTA: En su caso; 
							la presente Licencia, Registro ó Regularización de construcción no exenta al titular del pago de 
							infracciones generadas previamente.
						</div>	
						<div class="row">
							<div class="col border border-dark p-2">
								Verificó:
							</div>
							<div class="col border border-dark p-2">
								Vo. Bo.:
							</div>
						</div>
					</div>
					
				</div>
			</div>


		</div>
		
		<script type="text/javascript">
		// window.print();

		var Config = {};
		Config.pixelsPerInch = 96;
		Config.pageHeightInCentimeter = 29.7; // must match 'min-height' from 'css/sheets-of-paper-*.css' being used
		Config.pageMarginBottomInCentimeter = 0; // must match 'padding-bottom' and 'margin-bottom' from 'css/sheets-of-paper-*.css' being used

		window.addEventListener("DOMContentLoaded", function () {
			applyPageBreaks();
		});

		function applyPageBreaks() {
			applyManualPageBreaks();
			applyAutomaticPageBreaks(Config.pixelsPerInch, Config.pageHeightInCentimeter, Config.pageMarginBottomInCentimeter);

			document.querySelectorAll(".document .page").forEach(function (element) {
				if (!element.classList.contains("has-events")) {
					element.addEventListener("blur", function () {
						applyPageBreaks();
					});

					element.classList.add("has-events");
				}
			});
		}

		/* Applies any manual page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
		function applyManualPageBreaks() {
			var docs, pages, snippets;
			docs = document.querySelectorAll(".document");

			for (var d = docs.length - 1; d >= 0; d--) {
				pages = docs[d].querySelectorAll(".page");

				for (var p = pages.length - 1; p >= 0; p--) {
					snippets = pages[p].children;

					for (var s = snippets.length - 1; s >= 0; s--) {
						if (snippets[s].classList.contains("page-break")) {
							pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");

							for (var n = snippets.length - 1; n > s; n--) {
								pages[p].nextElementSibling.insertBefore(snippets[n], pages[p].nextElementSibling.firstChild);
							}

							snippets[s].remove();
						}
					}
				}
			}
		}

		/* Applies (where necessary) automatic page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
		function applyAutomaticPageBreaks(pixelsPerInch, pageHeightInCentimeter, pageMarginBottomInCentimeter) {
			var inchPerCentimeter = 0.393701;
			var pageHeightInInch = pageHeightInCentimeter * inchPerCentimeter;
			var pageHeightInPixels = Math.ceil(pageHeightInInch * pixelsPerInch);
			var pageMarginBottomInInch = pageMarginBottomInCentimeter * inchPerCentimeter;
			var pageMarginBottomInPixels = Math.ceil(pageMarginBottomInInch * pixelsPerInch);
			var docs, pages, snippets, pageCoords, snippetCoords;
			docs = document.querySelectorAll(".document");

			for (var d = docs.length - 1; d >= 0; d--) {
				pages = docs[d].querySelectorAll(".page");

				for (var p = 0; p < pages.length; p++) {
					if (pages[p].clientHeight > pageHeightInPixels) {
						pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");
						pageCoords = pages[p].getBoundingClientRect();
						snippets = pages[p].querySelectorAll("h1, h2, h3, h4, h5, h6, p, ul, ol");

						for (var s = snippets.length - 1; s >= 0; s--) {
							snippetCoords = snippets[s].getBoundingClientRect();

							if ((snippetCoords.bottom - pageCoords.top + pageMarginBottomInPixels) > pageHeightInPixels) {
								pages[p].nextElementSibling.insertBefore(snippets[s], pages[p].nextElementSibling.firstChild);
							}
						}

						pages = docs[d].querySelectorAll(".page");
					}
				}
			}
		}
		</script>
        <?php $this->endBody() ?>
	</body>
</html>


<?php $this->endPage(); ?>

