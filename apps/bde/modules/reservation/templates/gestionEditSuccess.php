<?php include_partial("insideMenu",array("param" => $param)) ?>

<h4><?php echo link_to ('Nouvelle salle', 'reservation_salle_new') ?></h4>

<h3>Liste des salles</h3>

<?php foreach ($salles as $salle): ?>

	<pre><?php echo $salle->getName() ?>
		<?php echo link_to ('edit', 'reservation_salle_update', array ('id' => $salle->getId())) ?>
		<?php echo link_to ('delete', 'reservation_salle_delete', array ('id' => $salle->getId())) ?>
	</pre>

<?php endforeach; ?>

