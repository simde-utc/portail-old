<?php	

$labels = array();
$data = array();
$datasets = array();

foreach ($assos as $asso){
	array_push($labels,$asso->getName());
}
foreach ($statAssos as $statAsso){
	array_push($data,$statAsso["count_resa"]);
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
