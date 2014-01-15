<?php
if(!isset($error)) {
	// Generate thumb (helpfull for big uploads)
	doThumb($photo->getImage(), 'galeries', array(
	    'width' => sfConfig::get('app_portail_photos_big_res_x'),
	    'height' => sfConfig::get('app_portail_photos_big_res_y'),
	), 'scale');

	doThumb($photo->getImage(), 'galeries', array(
	    'width' => sfConfig::get('app_portail_photos_thumb_res_x'),
	    'height' => sfConfig::get('app_portail_photos_thumb_res_y'),
	    ), 
	'center') ;

	$result = array(
		"success" => true
	);
}
else {
	$result = array(
	  "error" => $sf_data->get('error', ESC_RAW)
  );
}
echo json_encode($result);
?>
