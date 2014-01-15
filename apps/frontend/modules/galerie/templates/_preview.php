<?php include_partial('galerie/header', array('galerie_photo' => $galery, 'fulldesc'=>False)) ?>

<div class="row-fluid">
  <ul class="thumbnails thumbfix">
	<?php foreach ($photos as $photo) : ?>
		<li class="span3 thumb-container">
		  <a class="thumbnail"  href="<?php
		  echo url_for('galerie/show?id='.$photo->getGaleriePhoto()->getId().
			  	'&photo='.$photo->getId().
			  	'&pass='.$photo->getPass()
			  	); ?>">
				<?php include_partial('photo/photoThumbnail', array('photo' => $photo)); ?>
		  </a>
		</li>   
	<?php endforeach ?>
  </ul>
  <a  class="pull-right" href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>">
  	<h4 class="gallery link">Voir l'album photo </h4>
  </a>
</div>
