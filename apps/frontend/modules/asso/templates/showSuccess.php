<?php use_helper('Text') ?>
<?php if(isset($flashwarn) && !empty($flashwarn)): ?>
  <div class="alert alert-block">
    <strong>Avertissement !</strong>
    <?php echo $flashwarn; ?>
  </div>
<?php endif ?>
<?php if(isset($flashinfo) && !empty($flashinfo)): ?>
  <div class="alert alert-block alert-info">
    <strong>Information !</strong>
    <?php echo $flashinfo; ?>
  </div>
<?php endif ?>
<div class="part" >
  <?php include_partial('asso/topbar', array('asso' => $asso)) ?>
  <?php include_component('asso', 'articles', array('asso' => $asso)) ?>
  <?php include_component('asso', 'events', array('asso' => $asso)) ?>
  <?php if($asso->isPole()): ?>
    <?php include_partial('asso/list', array('assos' => $assos)) ?>
  <?php endif ?>
</div>