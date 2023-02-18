<?php 
use yii\bootstrap5\Html;
use common\models\Documento;
use yii\helpers\Url;

/* 
* $expediente common\models\Expediente
* $solicitudConstruccion common\models\SolicitudConstruccion
* $soliHasDocuments common\models\SolicitudConstruccionHasDocumento
*
*

*/

$this->registerCss("
    
/* @media print{ */
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
/* }  */
  
   .print-soli-cont{       
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
<button id="print-btn" class="btn btn-success m-1"  onclick="window.print(); ">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
    </svg> 
    Imprimir
</button>
<!-- d-flex justify-content-center outlined-box  -->


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
        <b>  SOLICITUD DE <?= strtoupper($solicitudConstruccion->motivoConstruccion->nombre)?>  DE CONSTRUCCIÓN </b>
    </div>
    

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Nombre del propietario:</b>
             <?=
               $solicitudConstruccion->solicitudConstruccionHasPersonas[0]->persona->nombre." ".
               $solicitudConstruccion->solicitudConstruccionHasPersonas[0]->persona->apellidoP." ".
               $solicitudConstruccion->solicitudConstruccionHasPersonas[0]->persona->apellidoM;
            
            ?> </div>   
        </div>
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col-8" ><b>Domicilio para notificaciones:</b> 
                <?=
                    $solicitudConstruccion->domicilioNotificaciones->calle." #Ext".  
                    $solicitudConstruccion->domicilioNotificaciones->numExt ." #Int:".  
                    $solicitudConstruccion->domicilioNotificaciones->numInt." "  
                ?> 
            </div>  
            <div class="col-4" ><b> Email:</b> <?= $solicitudConstruccion->contacto->email  ?> </div>   
        </div>
        <div class="row  ">
            <div class="col-8" ><b> Colonia/Fracc/Barrio:</b> <?= $solicitudConstruccion->domicilioNotificaciones->coloniaFraccBarrio." CP: ". $solicitudConstruccion->domicilioNotificaciones->cp  ?> </div>  <div class="col-3" > <b>Telefono:</b> <?= "1234567789"  ?> </div>   
        </div>
    </div>


    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Motivo de la solicitud:</b> <?= $solicitudConstruccion->motivoConstruccion->nombre  ?>   </div>   
        </div>
    </div>


    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Tipo de predio:</b>  <?= $solicitudConstruccion->tipoPredio->nombre  ?>    </div>  
            <div class="col" ><b>Superficie total:</b>  <?= $solicitudConstruccion->superficieTotal  ?>   </div>  
            <div class="col" ><b>Superficie por construir:</b>    <?= $solicitudConstruccion->superficiePorConstruir  ?>  </div>   
        </div>
    </div>


    <!-- Domicilio del predio -->
    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col " ><b>Ubicación del predio:</b> 
                <?=
                 $solicitudConstruccion->domicilioPredio->calle.
                 " #Ext: ".$solicitudConstruccion->domicilioPredio->numExt .
                 " #Int: ".$solicitudConstruccion->domicilioPredio->numInt." "  
                ?> 
            </div>  
        </div>
        <div class="row  ">
            <div class="col " > <b>Entre calles:</b> 
                <?=
                  $solicitudConstruccion->domicilioPredio->entreCallesH." Y ".
                  $solicitudConstruccion->domicilioPredio->entreCallesV
                ?> 
            </div> 
            <div class="col " ><b> Colonia/Fracc/Barrio:</b>
                <?= $solicitudConstruccion->domicilioPredio->coloniaFraccBarrio  ?> 
            </div>             
        </div>

        <div class="row">
            <div class="col " ><b> CP:</b> <?= $solicitudConstruccion->domicilioPredio->cp  ?> </div>  
        </div>
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Genero: </b>  <?= $solicitudConstruccion->generoConstruccion->nombre ?>   </div>  
            <div class="col" ><b>TIPO: </b>  <?= $solicitudConstruccion->tipoConstruccion->nombre.";;;Popular/Residencial//Comercial..etc???"  ?>   </div>           
        </div>
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Niveles: </b>  <?= $solicitudConstruccion->niveles  ?>   </div>  
            <div class="col" ><b>Cajones: </b>  <?= $solicitudConstruccion->cajones  ?>   </div>           
            <div class="col" ><b>COS: </b>  <?= $solicitudConstruccion->COS  ?>   </div>  
            <div class="col" ><b>CUS: </b>  <?= $solicitudConstruccion->CUS ?>   </div>           
            <div class="col" ><b>M2 Preexistentes: </b>  <?= $solicitudConstruccion->superficiePreexistente ?>   </div>          
        </div>
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" ><b>Titulo de propiedad: </b>  <?="Pendiente de agregar a DB" /* $solicitudConstruccion->tituloPropiedad */  ?>   </div>  
            <div class="col" ><b>RPP: </b>  <?= $solicitudConstruccion->RPP  ?>   </div>           
            <div class="col" ><b>Tomo: </b>  <?= $solicitudConstruccion->tomo  ?>   </div>  
            <div class="col" ><b>Folio electrónico: </b>  <?= $solicitudConstruccion->folioElec ?>   </div>           
            <div class="col" ><b>Clave/Cuenta catastral: </b>  <?= $solicitudConstruccion->cuentaCatastral  ?>   </div>  
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
                <?php foreach ($soliHasDocuments as $key => $soliHasDocument ) { ?>
                            
                    <div class="row ">
                            <div class="col text-break" >
                                <?= Html::checkbox("[$key]id_Documento",$soliHasDocument->isEntregado,
                                    /* [
                                        'options' => ['class' => 'col-md-1', 'display' => 'none'],
                                    ] */);
                                ?>   
                                <span >                                
                                    <?=  (Documento::findOne( ["id"=>$soliHasDocument->id_Documento/* /84 */]) -> nombre )  ?>            
                                </span>                                                    
                            </div>

                        
                    </div>
                    
                <?php }  ?> 
                <div class="row  ">
                    <div class="col">
                        <b>Nota:</b> La receipción de la solicitud no implica su aprobación o procedencia; pudiendo resultar en positiva o negativa, en su caso podrá requerirse información complementaria.
                    </div>
                </div>
            </div>


            <div className="viewport-canvas" class="  col-6 d-flex align-items-stretch ">
                 
                    <canvas id="canvasCroquis" class="d-block "  >
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                
            </div>    

        </div>
    </div>   
    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row mb-5 ">
            <div class="col mb-5" ><b>Nombre y firma del propietario(s) o apoderado: </b>  <?= " "  ?>   </div>  
            <div class="col mb-5" ><b>Director responsable de obra (nombre, registro y firma): </b>    </div>           
           
         </div>
    </div>


    <div class="container-xl outlined-box p-1 m-1">
        <div class="row  ">
            <div class="col " ><b>Expediente: </b>  <?= $expediente->idAnual."/".$expediente->anio ?>   </div>  
            <div class="col" ><b> Fecha Ingreso: </b> <?= date("d/m/Y - h:i a", strtotime($expediente->fechaCreacion) ) ?>   </div>           
            <div class="col" ><b> Fecha Notificación: </b>    </div>           
            <div class="col" ><b> Fecha Reingreso: </b>    </div>           
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
            

            ctx.font = `${18}px sans-serif`;
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

 
            ctx.font = `${18}px sans-serif`;
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

        drawCallesH("<?= $solicitudConstruccion->domicilioPredio->entreCallesH  ?>");
        drawCallesV("<?= $solicitudConstruccion->domicilioPredio->entreCallesV  ?>");


    </script> 
