[<?php
$result = array();
$i=0;
foreach ($assos as $asso) 
{
  if($i!=0) { echo ","; } else { $i++; }
  $arr = array(
    "id" => ($asso->getId()),
    "name" => ($asso->getName()), 
    "login" => ($asso->getLogin()),
    "description" => ($asso->getDescription()),
    "url" => url_for('asso_show',$asso)
  );
    
  echo json_encode($arr);
}
?>]
