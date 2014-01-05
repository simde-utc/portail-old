<div class="row-fluid">
  <ul class="thumbnails thumbfix">
		<?php foreach ($photos as $photo)
			include_partial('photo/photoThumbnail', array('photo' => $photo));      
		?>
  </ul>
</div>
