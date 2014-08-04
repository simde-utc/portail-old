<?php  
$result = array();
foreach ($reservations as $res){
  if($res->getAsso()->getId()) 
  $title = $res->getAsso()->getName();
  else
    $title = $res->getUserReserve()->getUsername();

$url = url_for('reservation_show', array("id" => $res->getID()));

if($res->getUserReserve()->getId()==$user->getId())
{
  $timestampResa = strtotime($res->getDate() . " " . $res->getheuredebut());
  
  if( $timestampResa-3600 > time() )
    $url = "modif";
}

  $result[] = array(
    "id" => ($res->getId()),
    "title" => $title,
    "allDay" => $res->getAllday(),
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    "color" => "#" . $res->getSalle()->getCouleur(),
    "url" => $url,
    "className" => (!$res->getEstvalide()) ? 'opacity' : ''
  );  
}
echo json_encode($result);
?>
