[<?php
$result = array();
$i=0;
foreach ($events as $event) 
{
  if($i!=0) { echo ","; } else { $i++; }
  echo json_encode(
              array(
                "id" => ($event->getId()),
                "title" => ($event->getAsso(). " - ".$event->getType()." - " .$event->getName()), 
                "start" => ($event->getStartDate()),
                "end" => ($event->getEndDate()),
                "url" => url_for(array("module"=>"event", "action"=>"edit", "id" => $event->getId())),
                "color" => ($event->getType()->getColor()),
                )
              );
}
?>]
