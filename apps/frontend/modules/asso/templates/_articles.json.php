[<?php if($articles->count() > 0)
$result = array();
$i=0;
foreach ($articles as $article) 
{
  if($i!=0) { echo ","; } else { $i++; }
  $arr = array(
    "id" => ($article->getId()),
    "asso" => array(
      "id" => ($article->getAsso()->getId()),
      "login" => ($article->getAsso()->getLogin()),
      "name" => ($article->getAsso()->getName())
    ),
    "name" => ($article->getName()), 
    "createdAt" => ($article->getCreatedAt()),
    "text" => ($article->getText(ESC_XSSSAFE)),
    "isWeekmail" => ($article->getIsWeekmail()),
    "summary" => ($article->getSummary()),
    // TODO
    // "imagePath" => ($article->getImage())
  );
  echo json_encode($arr);
}
?>]
