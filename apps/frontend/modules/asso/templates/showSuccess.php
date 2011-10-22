<?php use_stylesheet('asso.css') ?>
<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $asso->getName() ?></h2>
  <?php include_partial('asso/topbar',array('asso' => $asso)) ?>
  <div id="asso">

    <ul>
      <li><a href="#articles">Articles</a></li>
      <li><a href="#events">Évènements</a></li>
      <li><a href="#bureau">Bureau</a></li>
      <li><a href="#trombi">Trombinoscope</a></li>
      <?php if($asso->isPole()) : ?><li><a href="#assos">Assos</a></li><?php endif; ?>
    </ul>

   <?php include_component('asso','articles',array('asso' => $asso)) ?>
   <?php include_component('asso','events',array('asso' => $asso)) ?>
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

<script>
  $("#asso").tabs();
</script>
