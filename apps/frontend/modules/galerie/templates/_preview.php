<?php include_partial('galerie/header', array('galerie_photo' => $galery, 'fulldesc'=>False)) ?>

<div class="row-fluid">
  <ul class="thumbnails thumbfix">
	<?php foreach ($photos as $key=>$photo) : ?>
		<li class="span3 thumb-container">
		<?php 
		// We do not display the last thumb if there will be a "show more" button instead.
		if($key<$thumbsToDisplay): ?>
			<a class="thumbnail"  href="<?php
			echo url_for('galerie/show?id='.$photo->getGaleriePhoto()->getId().
		  		'&photo='.$photo->getId().
			  	'&pass='.$photo->getPass()
			  	); ?>">
				<?php include_partial('photo/photoThumbnail', array('photo' => $photo)); ?>
			</a>
		<?php endif; ?>
		</li>
	<?php endforeach ?>
	<?php if($showMoreButton):?>
		<li class="span3 thumb-container">
		<?php if($totalVisible>$thumbsToDisplay):
			// If the user can see more photos by opening the gallery ?>
			<a  href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>">
				 <h4 class="gallery link">Voir les <?php echo $totalVisible ?> photos.</h4>
			</a>
		<?php endif; ?>
		<?php if($totalPrivate>$totalVisible):
			// If the user can see more photos by logging in  ?>
			 <h4 class="gallery link">
			 <a  href="<?php echo url_for('cas') ?>">
			 Se connecter pour voir les <?php echo $totalPrivate ?> photos.
			 </a></h4>
		<?php endif; ?>
		</li>
	<?php endif; ?>
  </ul>
</div>