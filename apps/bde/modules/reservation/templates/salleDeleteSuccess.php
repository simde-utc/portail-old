<?php include_partial("insideMenu",array("param" => $param)) ?>

<h2>Suppression de la salle</h2>
	
<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>


	<?php include_partial("showSalle",array("salle" => $salle)) ?>


<?php if (!$suppr): ?>

	<form action="<?php echo url_for('reservation_salle_delete', array('id' => $id)) ?>" method="post">

		 <input type="submit" value="Suppression" />

	</form>

<?php else: ?>

	<p>Cette salle a été supprimée avec succès !</p>

<?php endif; ?>
