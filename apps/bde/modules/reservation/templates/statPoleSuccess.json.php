<?php	

$labels = array();
$data = array();
$datasets = array();

foreach ($poles as $pole){
	$pole_asso = AssoTable::getInstance()->getOneById($pole->getAssoId())->execute();
	array_push($labels, $pole_asso[0]->getName());
}

foreach ($statPoles as $statPole){
	array_push($data,$statPole["count_resa"]);
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
