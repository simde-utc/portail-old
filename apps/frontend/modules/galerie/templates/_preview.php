<h3 class="gallery title"> Album <?php echo $galery->getTitle(); ?></h3>
<div class="row-fluid">
  <ul class="thumbnails thumbfix">
	<?php foreach ($photos as $photo)
		include_partial('photo/photoThumbnail', array('photo' => $photo));      
	?>  
  </ul>
  <?php if ($photoCount > 1): ?>
    <a href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>"> <h4 class="gallery link">Voir l'album et ses <?php  echo $photoCount ?> photos</h4></a>
  <?php endif; ?>
</div>
<hr/>