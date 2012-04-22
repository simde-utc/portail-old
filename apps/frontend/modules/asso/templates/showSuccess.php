<?php use_helper('Text') ?>

<div class="part" >
  <?php include_partial('asso/topbar', array('asso' => $asso)) ?>
  <?php include_component('asso', 'articles', array('asso' => $asso)) ?>
  <?php include_component('asso', 'events', array('asso' => $asso)) ?>
</div>

<?php if($asso->isPole()): ?>
  <div id="assos">
    <h3>Associations de <?php echo $asso->getName() ?></h3>
    <div class="assos_pole">
      <?php include_partial('asso/list', array('assos' => $assos)) ?>
    </div>
  </div>
  <?php
 endif ?>