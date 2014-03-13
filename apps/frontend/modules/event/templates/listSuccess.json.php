<?php
$result = array();
foreach ($events as $event){
  $result[] = array(
    "id" => ($event->getId()),
    "title" => ($event->getAsso()->getName(ESC_XSSSAFE)." - " .$event->getName(ESC_XSSSAFE)), 
    "start" => (strtotime($event->getStartDate())),
    "end" => (strtotime($event->getEndDate())),
    "url" => url_for('event_show',$event),
    "color" => ($event->getAsso()->isPole())?($event->getAsso()->getPoleInfos()->getCouleur()) :($event->getAsso()->getPole()->getCouleur()),
    "allDay" => (strtotime($event->getEndDate()) - strtotime($event->getStartDate()) > 24*3600) ? true : false,
    "summary" => truncate_text($event->getDescription(), 256),
    "type" => ($event->getType()->getName()),
    "formated_date" => format_date($event->getStartDate(), 'f', 'fr') . " - " . format_date($event->getEndDate(), 'f', 'fr'),
    "asso" => event_from_asso_list($event)
  );  
}
echo json_encode($result);
?>
