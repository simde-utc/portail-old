<?php use_helper('Thumb') ?>
<li class="span3 thumb-container">
  <a class="thumbnail"  href="<?php
  echo url_for('galerie/show?id='.$photo->getGaleriePhoto()->getId().
	  	'&photo='.$photo->getId().
	  	'&pass='.$photo->getPass()
	  	); ?>">
    <?php echo showThumb($photo->getImage(), 'galeries', array(
    'width' => 250,
    'height' => 250,
    'class' => 'galery-thumbnail'
    ), 
    'center') ?> 
  </a>
</li>   