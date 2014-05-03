<?php use_stylesheet("reservation.css") ?>

<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<h2>Suppression de la salle</h2>
	
<p><?php echo link_to ('<< retour', 'reservation_salles') ?></p>

<p><b>Nom</b> : <?php echo $salle->getName() ?></p>
<p><b>Capacite</b> : <?php echo $salle->getCapacite() ?></p>
<p><b>Couleur</b> : <?php echo $salle->getCouleur() ?></p>
<p><b>Pole</b> : <?php echo $salle->getPole() ?></p>

<form action="<?php echo url_for('reservation_salles_delete', array('id' => $id)) ?>" method="post">

	 <input type="submit" value="Suppression" />

</form>

