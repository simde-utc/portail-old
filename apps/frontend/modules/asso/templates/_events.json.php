[<?php
$result = array();
$i=0;
foreach ($events as $event) 
{
  if($i!=0) { echo ","; } else { $i++; }
  $arr = array(
    "nom" => ($event->getName()),
    "description" => ($event->getSummary()), 
    "startDate" => ($event->getStartDate()),
    "endDate" => ($event->getEndDate()),
    "summary" => ($event->getDescription()),
    "place" => ($event->getPlace())
  );
  echo json_encode($arr);
}
?>]
