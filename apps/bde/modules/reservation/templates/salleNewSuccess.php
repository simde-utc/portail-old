<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<?php use_javascript("jscolor/jscolor.js") ?>

<h2>Nouvelle salle</h2>

<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>

<?php if (!isset($salle)): ?>

	<form action="<?php echo url_for('reservation_salle_new') ?>" method="post">

		<?php echo $form ?>
		<br />
		<input type="submit" />

	</form>
	
<?php else: ?>

	<p><b>Nom</b> : <?php echo $salle->getName() ?></p>
	<p><b>Capacite</b> : <?php echo $salle->getCapacite() ?></p>
	<p><b>Couleur</b> : <?php echo $salle->getCouleur() ?></p>
	<p><b>Pole</b> : <?php echo $salle->getPole() ?></p>

<?php endif; ?>