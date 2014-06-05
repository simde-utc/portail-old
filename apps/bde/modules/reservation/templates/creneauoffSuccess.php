<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Gestion des creneaux off</h3>

<div id="form_creneau">
	
	<p>Astuce : restez appuyer sur la touche "ctrl" afin de sélectionner plusieurs salles :)</p>
	
	<div class="left">
		<h4>Ajout creneau off journée</h4>
		<form method="post" action="<?php url_for ('reservation_creneauoff') ?>">
			<?php echo $formDay ?>
			<br />
			<input type="submit" name="day" value="Valider" />		
		</form>
	</div>

	<div class="right">
		<h4>Ajout creneau off horaire</h4>
		<form method="post" action="<?php url_for ('reservation_creneauoff') ?>">
			<?php echo $formHour ?>
			<br />
			<input type="submit" name="hour" value="Valider" />
		</form>
	</div>
	
<div>


