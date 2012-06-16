<?php use_helper('Text') ?>

<div class="part" >
  <?php include_partial('asso/topbar', array('asso' => $asso)) ?>
  <?php include_component('asso', 'articles', array('asso' => $asso)) ?>
  <?php include_component('asso', 'events', array('asso' => $asso)) ?>
  <?php if($asso->isPole()): ?>
    <?php include_partial('asso/list', array('assos' => $assos)) ?>
  <?php endif ?>
</div>