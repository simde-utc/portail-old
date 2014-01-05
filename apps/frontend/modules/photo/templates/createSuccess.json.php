<?php
if(!isset($error)) {
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
