[<?php
$result = array();
$i=0;
foreach ($events as $event) 
{
  if($i!=0) { echo ","; } else { $i++; }
  $arr = array(
    "id" => ($event->getId()),
    "title" => ($event->getAsso(). " - ".$event->getType()." - " .$event->getName()), 
    "start" => (strtotime($event->getStartDate())),
    "end" => (strtotime($event->getEndDate())),
    "url" => url_for('event_show',$event),
    "color" => ($event->getAsso()->getPole()->getCouleur())
  );
  if(strtotime($event->getEndDate()) - strtotime($event->getStartDate()) > 24*3600)
    $arr["allDay"] = "true";
    
  echo json_encode($arr);
}
?>]
