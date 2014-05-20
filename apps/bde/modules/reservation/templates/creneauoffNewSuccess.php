<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Nouveaux des creneaux off</h3>

<h4><?php echo link_to('<< retour','reservation_creneauoff') ?></h4>


<?php if (isset($date)): // si envoie du formulaire ?>

	<?php if (isset($creneau)): ?>	
		
		<p><b>Nouveau Creneau crée : <?php echo $creneau ?></b></p>

	<?php elseif (isset($exist)): ?>

		<p><b>Erreur : Le creneau existe déjà :)</b></p>

	<?php else: ?>

		<p><b>Erreur : Vous ne pouvez pas choisir un creneau dans le passé :)</b></p>
	
	<?php endif ?>


<?php endif; ?>

<form action="<?php echo url_for('reservation_creneauoff_new') ?>" method="post">

	<?php echo $form ?>
	<br />
	<input type="submit" name="submit" value="Valider" />
</form>
	
	

