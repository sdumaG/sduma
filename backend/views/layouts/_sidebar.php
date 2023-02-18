 
<?php echo yii\bootstrap5\Nav::widget([
 
 'options'=>[
    'class' => ['list-group min-width:1000px; width:content;']
 ],
 'params' => $_GET,
 'items'=>[
   
      [
        'label'=> 'Usuarios',
        'url' => ['/user/index'],
        'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ]
 
      ],
     [
       'label'=> 'Motivo Construccion',
       'url' => ['/motivo-construccion/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
       'label'=> 'Tipo Predio',
       'url' => ['/tipo-predio/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
      'label'=> 'Genero Construccion',
      'url' => ['/genero-construccion/index'],
      'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
      /* 'active' => true */
      ],
     [
       'label'=> 'Sub-Genero Construccion',
       'url' => ['/sub-genero-construccion/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
       'label'=> 'Tipo Trámite',
       'url' => ['/tipo-tramite/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
       'label'=> 'Documentos',
       'url' => ['/documento/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ], 
     [
       'label'=> 'Configuración de documentos',
       'url' => ['/config-tramite-motivo-cuentacon-doc/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ]
     ],
     [
       'label'=> 'Directores Responsables de Obra',
       'url' => ['/director-responsable-obra/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
       'label'=> 'Corr. Seguridad Estructural',
       'url' => ['/corr-seguridad-estruc/index'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
        'label'=> 'Horario',
        'url' => ['/horario/index'],
        'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ]
 
      ] 
 ]
])
?>

<!--  -->
<!-- <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    The current link item
  </a>
  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
  <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
</div> -->

 