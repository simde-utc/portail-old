<h4><?php echo link_to ('Nouvelle salle', 'reservation_salles_new') ?></h4>

<h3>Liste des salles</h3>

<?php foreach ($salles as $salle): ?>

	<pre><?php echo $salle->getName() ?>
		<?php echo link_to ('edit', 'reservation_salles_update', array ('id' => $salle->getId())) ?>
		<?php echo link_to ('delete', 'reservation_salles_delete', array ('id' => $salle->getId())) ?>
	</pre>

<?php endforeach; ?>

