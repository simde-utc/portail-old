<?php
$result = array();
foreach ($reservation as $res){
  if($res->getAsso()->getId()) 
	$title = $res->getAsso()->getName();
  else
  	$title = $res->getUserReserve()->getName();
  $result[] = array(
    "id" => ($res->getId()),
    "title" => $title,
    "allDay" => false,
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    "color" => "#" . $res->getSalle()->getCouleur(),
    "url" => url_for('reservation_show', array("id" => $res->getID())),
    "className" => (!$res->getEstvalide()) ? 'opacity' : ''
  );  
}
echo json_encode($result);
?>
