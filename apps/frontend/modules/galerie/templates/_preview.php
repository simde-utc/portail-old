<hr/>
<a href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>">
<h2> <?php echo $galery->getTitle(); ?>
( <?php  echo $photoCount ?> photo<?php if ($photoCount > 1) echo "s"; ?>)
</h2>
</a>

<div class="row-fluid">
  <ul class="thumbnails thumbfix">
		<?php foreach ($photos as $photo)
			include_partial('photo/photoThumbnail', array('photo' => $photo));      
		?>
		<?php if ($photoCount > $photos->count()): ?>
			<li class="span3" >
			<a href="<?php echo url_for('galerie/show?id='.$galery->getId()) ?>">
			    <h2>Voir toutes les photos.</h2>
			</a>
			</li>   		
		<?php  endif; ?>   
  </ul>
</div>
