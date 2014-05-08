<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<?php use_javascript("jscolor/jscolor.js") ?>

<h2>Modification de la salle</h2>
	
<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>

<?php if (!$update): ?> 

	<form action="<?php echo url_for('reservation_salle_update',array('id' => $id)) ?>" method="post">

		 <?php echo $form ?>
		 <br />
		 <input type="submit" />

	</form>
	
<?php else: ?>

	<p>Modification réalisée avec succès !</p>

	<p><b>Nom</b> : <?php echo $salle_modif->getName() ?></p>
	<p><b>Capacite</b> : <?php echo $salle_modif->getCapacite() ?></p>
	<p><b>Couleur</b> : <?php echo $salle_modif->getCouleur() ?></p>
	<p><b>Pole</b> : <?php echo $salle_modif->getPole() ?></p>	
	

<?php endif; ?>

