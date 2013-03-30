<?php

$start = mktime(8,0,0,3,6,2013);
$end = mktime(23,59,59,3,6,2013);
$time = time();
if($time < $start || $time > $end) {
	echo 'Il n\'y a pas d\'&eacute;lection aujourd\'hui, repassez plus tard.';
	exit;
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('election', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
