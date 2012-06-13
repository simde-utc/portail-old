<?php
$result = array();
foreach ($events as $event){
  $result[] = array(
    "id" => ($event->getId()),
    "title" => ($event->getAsso()->getName()." - " .$event->getName()), 
    "start" => (strtotime($event->getStartDate())),
    "end" => (strtotime($event->getEndDate())),
    "url" => url_for('event_show',$event),
    "color" => ($event->getAsso()->getPole()->getCouleur()),
    "allDay" => (strtotime($event->getEndDate()) - strtotime($event->getStartDate()) > 24*3600) ? true : false
  );  
}
echo json_encode($result);
?>
