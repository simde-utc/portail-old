<?php	
$result = array();
foreach ($reservations as $res){
  if($res->getAsso()->getId()) 
	$title = $res->getAsso()->getName();
  else
  	$title = $res->getUserReserve()->getName();

$url = url_for('reservation_show', array("id" => $res->getID()));

if($res->getUserReserve()->getId()==$user->getId())
	//if(strtotime($res->getDate())<time() || strtotime($res->getheurefin())-time()>3600))
	if( strtotime($res->getDate()) > time() )
		$url = "modif";
	elseif(strtotime($res->getheurefin())-time()>3600)
		$url = "modif";

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
