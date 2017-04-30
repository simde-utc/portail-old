<?php
$return = array(
	"login" => $user->getUsername(),
	"semestres" => array()
);

foreach($user->getAssoMember() as $assoMember)
{
	if (!array_key_exists($assoMember->getSemestre()->getId(), $return["semestres"])) {
		$return["semestres"][$assoMember->getSemestre()->getId()] = array(
			"semestre" => $assoMember->getSemestre()->getName(),
			"roles" => array()
		);
	}
	  $arr = array(
	  "role" => array(
	  	"id" => ($assoMember->getRole()->getId()),
	  	"name" => ($assoMember->getRole()->getName()),
	  	"bureau" => ($assoMember->getRole()->getBureau())
	  	),
	  "asso" => array(
	  	"id" => ($assoMember->getAsso()->getId()),
	  	"name" => ($assoMember->getAsso()->getName()),
	  	"login" => ($assoMember->getAsso()->getLogin())
	  	),
	  );
	  // die(var_dump($return["semestres"][$assoMember->getSemestre()->getId()])); 
	  array_push($return["semestres"][strval($assoMember->getSemestre()->getId())]["roles"], $arr);
}
echo json_encode($return);
?>
