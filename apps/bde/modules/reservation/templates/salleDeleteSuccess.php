<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<h2>Suppression de la salle</h2>
	
<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>

	<p><b>Nom</b> : <?php echo $salle->getName() ?></p>
	<p><b>Capacite</b> : <?php echo $salle->getCapacite() ?></p>
	<p><b>Couleur</b> : <?php echo $salle->getCouleur() ?></p>
	<p><b>Pole</b> : <?php echo $salle->getPole() ?></p>

<?php if (!$suppr): ?>

	<form action="<?php echo url_for('reservation_salle_delete', array('id' => $id)) ?>" method="post">

		 <input type="submit" value="Suppression" />

	</form>

<?php else: ?>

	<p>Cette salle a été supprimée avec succès !</p>

<?php endif; ?>
