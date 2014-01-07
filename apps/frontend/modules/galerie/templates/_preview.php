<h3 class="gallery title"> Album <?php echo $galery->getTitle(); ?></h3>
<div class="row-fluid">
  <ul class="thumbnails thumbfix">
	<?php foreach ($photos as $photo)
		include_partial('photo/photoThumbnail', array('photo' => $photo));      
	?>  
  </ul>
  <a href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>"> <h4 class="gallery link">Voir l'album photo </h4></a>
  
</div>
<hr/>