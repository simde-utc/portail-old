<a class="changesize btn btn-primary" href="#"></a>
<div class="row-fluid">
  <ul class="thumbnails thumbfix">
		<?php foreach ($photos as $photo)
			include_partial('photo/photoThumbnail', array('photo' => $photo));      
		?>
  </ul>
</div>

<?php use_javascript('jquery.lazyload.min.js'); ?>
<?php use_javascript('galery_photo_list'); ?>
