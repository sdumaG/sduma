<?php 
 $this->registerCss("
    
 /* @page
 {
   size:A4;
   margin: 0;
   
 } */
 
 
    #print-btn
    { 
        /*  background-color: red; */
        /* display: none;
        visibility: none; */
        
    }
    
    .imprimible-container{

       /*  outline: solid 1px black; */
        font-size: 12px;

    }

    .outlined-box{

        outline: solid 1px black;

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


<div class="container imprimible-container pt-3 pb-3">

    <div class="d-flex flex-column flex-sm-nowrap align-items-center">
        <div><b>SECRETARIA DE DESARROLLO URBANO Y MEDIO AMBIENTE</b></div>
        <div>DIRECCIÓN DE DESARROLLO URBANO</div>
        <div> DEDPARTAMENTO DE EDIFICACIÓN</div>
    </div>


    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="d-flex flex-column flex-sm-nowrap align-items-center  ">
            <?= "s"  ?> DE CONSTRUCCIÓN
        </div>        
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="d-flex flex-row flex-nowrap justify-content-between ">
            <div>GENÉRO</div>
            <div><?= "COMERCIAL"  ?></div>
            <div>BIT <?= "xxx"  ?></div>
        </div>        
    </div>

    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="d-flex flex-row flex-nowrap justify-content-between ">
            <div>TIPO</div>
            <div><?= "DOS NIVELES"  ?></div>
            <div>PCT <?= "xxx"  ?></div>
        </div>        
    </div>


    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" >  SE OTORGA AL C.</div>  <div class="col" > <?= "ABEL LEON GUTIERREZ"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >  DOMICILIO PARA NOTIFICACIONES </div> <div class="col" > <?= "ESTA ES LA CALLE #000"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >  COL / FRACC / BARRIO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
    </div>


    <div class="container-xl outlined-box p-1 m-1 ">
        <div class="row  ">
            <div class="col" >OBRA UBICADA EN LA CALLE</div>  <div class="col" > <?= "PREDIO CALLE"  ?> </div>   
        </div>
        <div class="row">
            <div class="col" >ENTRE LA CALLE (VIENTO NORTE)</div> <div class="col" > <?= "ESTA ES LA CALLE #000"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >Y LA CALLE (VIENTO ORIENTE)</div> <div class="col" > <?= "ESTA ES LA CALLE #000"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >COL / FRACC /BARRIO</div> <div class="col" > <?= "ESTA ES LA CALLE #000"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >TITULO DE PROPIEDAD</div> <div class="col" > <?= "ESTA ES LA CALLE #000"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >REGISTRO PÚBLICO  DE LA PROPIEDAD </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >TOMO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >CUENTA PREDIAL </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >TOMA C.A.P.A.S.U. </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >LICENCIA DE USO DE SUELO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >DICTAMEN DE PROTECCIÓN CIVIL </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >DICTAMEN DE IMPACTO AMBIENTAL </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >CONCESION CONAGUA </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >FOLIO DE ALINEAMIENTO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >DIRECTOR RESPONSABLE DE OBRA </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >CORRESPONSABLE ELECTROMECANICO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >FOLIO DE ALINEAMIENTO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
        <div class="row">
            <div class="col" >FOLIO DE ALINEAMIENTO </div> <div class="col" > <?= "ESTA ES LA COLONIA"  ?> </div>   
        </div>    
    </div>

</div>