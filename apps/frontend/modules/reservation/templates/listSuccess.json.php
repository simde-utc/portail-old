<?php	
$result = array();
foreach ($reservations as $res){
  if($res->getAsso()->getId()) 
	$title = $res->getAsso()->getName();
  else
  	$title = $res->getUserReserve()->getName();

if(strtotime($res->getheurefin())-time()>3600 && $res->getUserReserve()->getId()==$user->getId())
	$url = "";
  else
	$url = url_for('reservation_show', array("id" => $res->getID()));

  $result[] = array(
    "id" => ($res->getId()),
    "title" => $title,
    "allDay" => false,
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    "color" => "#" . $res->getSalle()->getCouleur(),
    "url" => $url,
    "className" => (!$res->getEstvalide()) ? 'opacity' : ''
  );  
}
echo json_encode($result);
?>
