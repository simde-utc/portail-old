[<?php
$i = 0;
foreach($membres as $membre)
{
  if($i!=0) { echo ","; } else { $i++; }
  $arr = array( 
  "login" => ($membre->getUser()->getUsername()),
  "role" => ($membre->getRole()->getName()),
  "bureau" => ($membre->getRole()->getBureau())
  );
  
  echo json_encode($arr);
 
}
?>
]
