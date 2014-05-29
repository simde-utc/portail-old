<?php
$result = array();
foreach ($reservations as $res){
  $asso = $res->getAsso();
  $result[] = array(
    "id" => ($res->getId()),
    "title" => $asso->getName(),
    "allDay" => false,
    "start" => strtotime($res->getDate() . " " . $res->getheuredebut()),
    "end" => strtotime($res->getDate() . " " . $res->getheurefin()),
    "color" => ($res->getAsso()->isPole())?($res->getAsso()->getPoleInfos()->getCouleur()) :($res->getAsso()->getPole()->getCouleur()),
    "url" => url_for('reservation_gestion_id',array('id'=>$res->getId())),
    "className" => (!$res->getEstvalide()) ? 'opacity' : ''
  );  
}
echo json_encode($result);
?>
