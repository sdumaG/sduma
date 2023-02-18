<?php 
use yii\bootstrap5\Html;
use common\models\Documento;
use yii\helpers\Url;

/* 
* $expediente common\models\Expediente
* $solicitudConstruccion common\models\SolicitudConstruccion
* $soliHasDocuments common\models\SolicitudConstruccionHasDocumento  
*/
/** @var common\models\SolicitudGenerica $solicitudAImprimir  */
$css3 = file_get_contents("bootstrap.min.css");
$this->registerCss($css3);


$this->registerCss("
 
@media print{ 
    .page{
        margin-left: 0cm;
        margin-top: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;
        size: A4 portrait;
    }
    @page {
        /* You can only change the size, margins, orphans, widows and page breaks here */
    
        /* Paper size and page orientation */
        size: A4 portrait;
    
        /* Margin per single side of the page */
        margin-left:    0cm;
        margin-top:     0cm;
        margin-right:   0cm;
        margin-bottom:  0cm;

        padding-left:   0cm;
        padding-top:    0cm;
        padding-right:  0cm;
        padding-bottom: 0cm;
    }
    

}   

@page {
    /* You can only change the size, margins, orphans, widows and page breaks here */

    /* Paper size and page orientation */
    size: A4 portrait;

    /* Margin per single side of the page */
    margin-left:    2cm;
    margin-top:     2cm;
    margin-right:   2cm;
    margin-bottom:  2cm;

    padding-left:   2cm;
    padding-top:    2cm;
    padding-right:  2cm;
    padding-bottom: 2cm;
}  
/* .print-soli-cont
{ 
  
  display: none;
  visibility: none;
  
} */
 
    body, main {
        padding: 0;
    }
    body > main {
        width: 100%;
        max-width: 100%;
        min-width: 100%;
        padding: 0;
    }
    nav,.navbar,header, footer{
        display:none;
        visibility: hidden;
        max-heigth: 1px;
        display: block !improtant;
        margin: 0px !important;
        border: 0px !important;
        padding: 0px !important;
    }
    #print-btn
    { 
       /*  background-color: red; */
      display: none;
      visibility: none;
      
    }

    main > .container{
        padding-top:0;
    }

  
   .print-soli-cont{    
        min-width: A4;
   
       font-size: 12pt;
   }
    .title-secretary{
        font-size: 15pt;
    }
    .title-secretary-secondary{
        font-size: 16pt;
    }
   .outlined-box{
       outline: solid 1px black;
   }

   .inverted-colors{
        background-color:gray;
        color:white;
        
    }

    
    
    ");

?> 
<script>
    document.addEventListener("DOMContentLoaded", function () {
    
       window.print();
        
    });
</script>

<!-- d-flex justify-content-center outlined-box  -->
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


        <div class="print-soli-cont">


            <div class="row flex-nowrap justify-content-between align-content-center align-items-center  p-1  mw-900">

                
                    <?php 
                        $img = Url:: to('@web/images/logourupan.png')  ;                 
                        echo Html::img($img , ['class' => 'col-1'/* 'pull-left img-responsive' */]);  
                    ?> 
                
            
                <div class="d-flex flex-column align-items-center col-10  ">

                    <div class="title-secretary ">SECRETARÍA DE DESARROLLO URBANO Y MEDIO AMBIENTE</div>
                    <div class="title-secretary-secondary "><b>DIRECCIÓN DE DESARROLLO URBANO</b></div>
                </div>

                <?php 
                        $img = Url:: to('@web/images/logourupan.png')  ;                 
                        echo Html::img($img , ['class' => 'col-1'/* 'pull-left img-responsive' */]);  

                    ?> 
            </div>

            <div class="container-xl p-1 m-1 d-flex justify-content-center inverted-colors">
                <b>  SOLICITUD DE <?= strtoupper($solicitudAImprimir->motivoConstruccion->nombre)?>  DE CONSTRUCCIÓN </b>
            </div>
            


            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col-8" ><b>Domicilio para notificaciones en Uruapan:</b> 
                        <?=
                            $solicitudAImprimir->domicilioNotificaciones->calle." #Ext".  
                            $solicitudAImprimir->domicilioNotificaciones->numExt ." #Int:".  
                            $solicitudAImprimir->domicilioNotificaciones->numInt." "  
                        ?> 
                    </div>  
                    <div class="col-4" ><b> Email:</b> <?= $solicitudAImprimir->contacto->email  ?> </div>   
                </div>
                <div class="row  ">
                    <div class="col-8" ><b> Colonia/Fracc/Barrio:</b> <?= $solicitudAImprimir->domicilioNotificaciones->coloniaFraccBarrio." CP: ". $solicitudAImprimir->domicilioNotificaciones->cp  ?> </div> 
                    <div class="col-3" > <b>Telefono:</b> <?= $solicitudAImprimir->contacto->telefono  ?> </div>   
                </div>
            </div>


            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col" ><b>Motivo de la solicitud:</b> <?= $solicitudAImprimir->motivoConstruccion->nombre  ?>   </div>   
                </div>
            </div>


            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col" ><b>Tipo de predio:</b>  <?= $solicitudAImprimir->tipoPredio->nombre  ?>    </div>  
                    <div class="col" ><b>Superficie total:</b>  <?= $solicitudAImprimir->superficieTotal  ?>   </div>  
                    <div class="col" ><b>Superficie por construir:</b>    <?= $solicitudAImprimir->superficiePorConstruir  ?>  </div>   
                </div>
            </div>


            <!-- Domicilio del predio -->
            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col " ><b>Ubicación del predio:</b> 
                        <?=
                        $solicitudAImprimir->domicilioPredio->calle.
                        " #Ext: ".$solicitudAImprimir->domicilioPredio->numExt .
                        " #Int: ".$solicitudAImprimir->domicilioPredio->numInt." "  
                        ?> 
                    </div>  
                </div>
                <div class="row  ">
                    <div class="col " > <b>Entre calles:</b> 
                        <?=
                        " Calle Norte y Sur".$solicitudAImprimir->domicilioPredio->calleNorte." - ".$solicitudAImprimir->domicilioPredio->calleSur.
                        " Calle Oriente y Poniente". $solicitudAImprimir->domicilioPredio->calleOriente." - ".$solicitudAImprimir->domicilioPredio->callePoniente
                        ?> 
                    </div> 
                    <div class="col " ><b> Colonia/Fracc/Barrio:</b>
                        <?= $solicitudAImprimir->domicilioPredio->coloniaFraccBarrio  ?> 
                    </div>             
                </div>

                <div class="row">
                    <div class="col " ><b> CP:</b> <?= $solicitudAImprimir->domicilioPredio->cp  ?> </div>  
                </div>
            </div>

       <!--      <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col" ><b>Genero: </b>   $solicitudAImprimir->generoConstruccion->nombre     </div>  
                    <div class="col" ><b>Sub-genero/clasificación: </b>   $solicitudAImprimir->subGeneroConstruccion->nombre     </div>  
                </div>
            </div> -->

            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">
                    <div class="col" ><b>Niveles: </b>  <?= $solicitudAImprimir->niveles  ?>   </div>                    
                    <div class="col" ><b>M2 Preexistentes: </b>  <?= $solicitudAImprimir->areaPreExistente ?>   </div>          
                </div>
            </div>

            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row  ">

                        
                </div>
            </div>
            <div class="container-xl outlined-box p-1 m-1">
                <div class="row align-items-stretch">

                
                    <div class="container-xl  col-6 entregables">
                        <div class="row my-2">
                            <div class="col">
                                <b> El solicitante integra la siguiente información documental:</b> 
                            </div>
                        </div>
                        <?php foreach ($solicitudAImprimir->solicitudGenericaHasDocumentos as $key => $curr ) { ?>
                                    
                            <div class="row ">
                                    <div class="col text-break" >
                                        <?= Html::checkbox("[$key]id_Documento",$curr->isEntregado,);
                                        ?>   
                                        <span >                                
                                            <?=  (Documento::findOne( ["id"=>$curr->id_Documento/* /84 */]) -> nombre )  ?>            
                                        </span>                                                    
                                    </div>

                                
                            </div>
                            
                        <?php }  ?> 
                        <div class="row  ">
                            <div class="col">
                                <b>Nota:</b> La recepción de la solicitud no implica su aprobación o procedencia; pudiendo resultar en positiva o negativa, en su caso podrá requerirse información complementaria.
                            </div>
                        </div>
                    </div>


                    <div className="viewport-canvas" class="  col-6 d-flex align-items-stretch ">
                        
                            <canvas id="canvasCroquis" class="d-block "  >
                            Su navegador no soporta canvas.
                            </canvas>
                        
                    </div>    

                </div>
            </div>   
            <div class="container-xl outlined-box p-1 m-1 ">
                <div class="row mb-5 ">
                    <div class="col-5 " ><b>Nombre y firma del propietario(s) o apoderado: </b>
                        <?php foreach ( $solicitudAImprimir->solicitudGenericaHasPersonas as $id => $curr) { ?>            
                            <?= Html::tag("span",$curr->persona->nombre . " " . $curr->persona->apellidoP. " " . $curr->persona->apellidoM,["class"=>"list-group-item"])  ?>
                        <?php } ?>
                        
                        </div>  
                    <div class="col-5" ><b>Director responsable de obra (nombre, registro y firma): </b>
                    <?= Html::tag("span",$solicitudAImprimir->directorResponsableObra->abreviacion . " ". $solicitudAImprimir->directorResponsableObra->persona->nombre . " " .$solicitudAImprimir->directorResponsableObra->persona->apellidoP . " " .$solicitudAImprimir->directorResponsableObra->persona->apellidoM,["class"=>"list-group-item"])  ?>


                </div>           
                
                </div>
            </div>


            <div class="container-xl outlined-box p-1 m-1">
                <div class="row  ">
                    <div class="col " ><b>Expediente: </b>  <?=/*  $expediente->idAnual. */"/"/* .$expediente->anio */ ?>   </div>  
                    <div class="col" ><b> Fecha Ingreso: </b> <?= date("d/m/Y - h:i a"/* , strtotime($expediente->fechaCreacion) */ ) ?>   </div>           
                    <div class="col" ><b> Fecha Entrega: </b> <?=  date("d/m/Y - h:i a") ?>   </div>           
                
                </div>
            </div>



        </div>


            <script>
                /* let width=1200;
                let height=600 */
                

                let c = document.getElementById("canvasCroquis");
                let ctx = c.getContext("2d");
                let dpi = window.devicePixelRatio;

        //get CSS height
                //the + prefix casts it to an integer
                //the slice method gets rid of "px"
                let style_height = +getComputedStyle(c).getPropertyValue("height").slice(0, -2);
                //get CSS width
                let style_width = +getComputedStyle(c).getPropertyValue("width").slice(0, -2);
                //scale the canvas
                c.setAttribute('height', dpi * style_height);
                c.setAttribute('width',  dpi * style_width );
                c.style.height = dpi*style_height;                            
                c.style.width = dpi*style_width;                            
                /* 5 espacios
                1 cuadro
                3 rectangulp
                1 cuadro

                4 x 0.25 espacios

                height / (9elementos x 4unidadesde.25)
                300/36 -> 8.33px cada unidad minima


                */
            /* decimales afectaban un poco, asi que se trunquea */
            //mide 24gaps de base
                let gap =         parseInt(  ((dpi*style_height )/24) ) +.5;
                let littleSquar =   (4*gap )+.5;
                let bigSquareBase =     (3*littleSquar)+.5;
                
                let currRotationCanvas = 0

            
            /*     ctx.moveTo(0.5,0.5)
                ctx.translate(0.5, 0.5); */


        /*         createRect(0,0,(dpi*style_width)-5,(dpi * style_height)-5)
                createRect( 1 ,0, 36.27,gap*23) */


                const drawCallesH = (callesH)=>{
                    /* context.restore() */
                    let origX = (gap + littleSquar + gap);
                    let origY =  (gap + littleSquar + gap );
                    
                    ctx.translate( origX,origY )
                    

                    ctx.font = `${16}px sans-serif`;
                    let calles = callesH.split(",")
                    ctx.fillText(calles[0],0 , 0);
                    
                    if(calles[1])
                        ctx.fillText(calles[1],0 ,  bigSquareBase+gap + littleSquar + gap );

                        
                    let newX = -(gap + littleSquar + gap);
                    let newY =  -(gap + littleSquar + gap );
                    ctx.translate( newX,newY );
                    
                /*  context.save() */
                }
        
                const drawCallesV = (callesV)=>{
                        //set position
                    
                    let origX = (gap + littleSquar + gap + bigSquareBase);
                    let origY =  (gap + littleSquar  + gap);
                    ctx.translate( origX,origY  )
                    ctx.rotate( (90 * Math.PI / 180) );

        
                    ctx.font = `${16}px sans-serif`;
                    let calles = callesV.split(",")
                    
                    ctx.fillText(calles[0],0 , 0);
                    
                    if(calles[1])
                        ctx.fillText(calles[1],0 ,  bigSquareBase+gap   );
        

                    //reset position alv
                    let newX = -( gap + littleSquar + gap + bigSquareBase)
                    let newY =  -(gap + littleSquar  + gap) ;
                    ctx.rotate( (-90 * Math.PI / 180) );
                    ctx.translate( newX,newY )
                    ctx.save()

                }
        
                createRect(gap,gap,littleSquar, littleSquar)
                createRect(gap,gap + littleSquar + gap,littleSquar, bigSquareBase)
                createRect(gap,gap + littleSquar + gap + bigSquareBase + gap, littleSquar, littleSquar)    
            
                createRect(gap + littleSquar + gap ,
                gap,
                bigSquareBase, 
                littleSquar
                )
                createRect(gap + littleSquar + gap ,
                gap + littleSquar + gap,
                bigSquareBase,
                bigSquareBase
                )
                createRect(gap + littleSquar + gap ,
                gap + littleSquar + gap + bigSquareBase + gap,
                bigSquareBase, 
                littleSquar
                )
        
                createRect(gap + littleSquar + gap + bigSquareBase + gap,gap,littleSquar, littleSquar)
                createRect( gap + littleSquar + gap + bigSquareBase + gap, gap + littleSquar + gap ,littleSquar,bigSquareBase)
                createRect( gap + littleSquar + gap + bigSquareBase + gap, gap + littleSquar + gap + bigSquareBase + gap,littleSquar, littleSquar)
        
                function createRect(x,y,w,h){
                    ctx.beginPath();
                    ctx.rect(
                        parseInt(x) + 0.5 , 
                        parseInt(y) + 0.5 , 
                        parseInt(w), 
                        parseInt(h)
                    );
                    ctx.stroke();
                    ctx.save()
                }

                drawCallesH("<?= $solicitudAImprimir->domicilioPredio->calleOriente . "," .  $solicitudAImprimir->domicilioPredio->callePoniente  ?>");
                drawCallesV("<?= $solicitudAImprimir->domicilioPredio->calleNorte . ",". $solicitudAImprimir->domicilioPredio->calleSur  ?>");


            </script> 
        <?php $this->endBody() ?>
	</body>
</html>


<?php $this->endPage(); ?>