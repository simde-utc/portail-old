<?php  

$labels = array();
$data = array();
$datasets = array();

foreach ($salles as $salle){
  array_push($labels,$salle->getName());
}
foreach ($statSalles as $statSalle){
  array_push($data,$statSalle["count_resa"]);
}

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
