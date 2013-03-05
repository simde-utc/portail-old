<?php

if(date('dmY') !== "06032013") {
	echo 'Il n\'y a pas d\'&eacute;lection aujourd\'hui, repassez plus tard.';
	exit;
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('election', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
