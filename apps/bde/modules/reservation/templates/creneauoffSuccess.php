<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Gestion des creneaux off</h3>

<h4><?php echo link_to('Nouveau Creneau Off','reservation_creneauoff_new') ?></h4>

<?php foreach ($creneauoff as $cre): ?>

	<p><?php echo $cre ?></p>

<?php endforeach; ?>

