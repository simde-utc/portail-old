<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<h1>Derniers événements ajoutés</h1>
<?php include_partial('event/eventbox', array('events' => $events)) ?>
