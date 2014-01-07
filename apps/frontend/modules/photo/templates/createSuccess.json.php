<?php
if(!isset($error)) {
	// Generate thumb (helpfull for big uploads)
	doThumb($photo->getImage(), 'galeries', array(
	    'width' => 1600,
	    'height' => 900
	), 'scale');

	doThumb($photo->getImage(), 'galeries', array(
	    'width' => 250,
	    'height' => 250,
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
