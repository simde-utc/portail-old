<?php use_stylesheet('home.css') ?>
<?php use_helper('Text') ?>


  <div class="part" >
    <?php include_partial('asso/topbar',array('asso' => $asso)) ?>
  <?php include_component('asso','articles',array('asso' => $asso)) ?>
   <?php include_component('asso','events',array('asso' => $asso)) ?>
</div>

  <div id="asso">

   <?php include_component('asso','bureau',array('asso' => $asso)) ?>
   <?php include_component('asso','trombinoscope',array('asso' => $asso)) ?>

    <?php if($asso->isPole()): ?>
    <div id="assos">
      <h3>Associations de <?php echo $asso->getName() ?></h3>
      <div class="assos_pole">
        <?php include_partial('asso/list',array('assos' => $assos)) ?>
      </div>
    </div>
    <?php endif ?>
    
  </div>

