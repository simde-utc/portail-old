<?php use_stylesheet('asso.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo isset($pole) ? $pole->getInfos()->getName() : "Liste des associations" ?></h2>

<?php include_partial('asso/list', array('assos' => $assos)) ?>