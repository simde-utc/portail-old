<h1>Liste des galeries photos</h1>

<?php foreach ($galerie_photos as $galerie_photo) : ?>
  <?php include_component('galerie', 'preview',  array('galery' =>  $galerie_photo)); ?>
  <?php endforeach ?>