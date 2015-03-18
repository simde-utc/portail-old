<?php  

$labels = array("janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre");
$datasets = array();

$data = array(0,0,0,0,0,0,0,0,0,0,0,0);
foreach ($statMois as $stat)
  $data[$stat["month"]-1] = $stat["count_resa"];

$data1 = array(
  "fillColor" => "rgba(151,187,205,0.5)",
  "strokeColor" => "rgba(151,187,205,1)",
  "data" => $data
);

array_push($datasets,$data1);

  $result[] = array(
   "labels" => $labels,
   "datasets" => $datasets
  );  

echo json_encode($result);
?>
