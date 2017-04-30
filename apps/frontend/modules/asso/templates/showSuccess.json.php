<?php
	// BONJOUR LA SALETE FUUUUUUUUUUUUUUUUUUU
	echo '{ ';
	echo ' "asso": ';
	include_partial('asso/list', array('assos' => array($asso)));
	echo ', "members": ';
	include_component('asso', 'trombinoscope', array('asso' => $asso));
	echo ',"articles": ';
	include_component('asso', 'articles', array('asso' => $asso));
	echo ',"events": ';
	include_component('asso', 'events', array('asso' => $asso));
	echo '}';
?>
