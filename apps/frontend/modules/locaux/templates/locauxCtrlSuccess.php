<div class="part">?>
	  <h1>Charte locaux</h1>
	  <p> Blablabla Voici la charte locaux blabla</p>
	  <div class="well">
		  <?php /*<form method="post" action="<?php echo url_for('locaux_post', $asso) ?>"> */?>
		  <h1>Récapitulatif de saisie:</h1>
		  <p>Nom: <?php echo $sf_user->getGuardUser()->getLastName() ?></p>
		  <p>Prénom: <?php echo $sf_user->getGuardUser()->getFirstName() ?></p>
		  <p>Association: <?php echo $charte->getAsso()->getName() ?></p>
		  <p>Accès demandés:
			<ul>
			<?php /*
			  if () echo "<li>Porte de la MDE</li>";
			  if () echo "<li>Batiment A</li>";
			  if () echo "<li>MDE complète</li>";
			  if () echo "<li>Locaux du PIC</li>";
			  if () echo "<li>Bureau du Polar</li>";
			  if () echo "<li>Permanence du Polar</li>";
			  if () echo "<li>Salles de musique</li>"; */
			?> 
			</ul>
		  </p>
		  <p>Motif:</p>
		  <p></p>
	 
			<p>En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
			<p><ul>
			  <li>avoir pris connaissance de la charte et l'approuver</li>
			  </ul>
			</p>
			<input type="text" name="check" /><br />
			<input type="submit" class="btn btn-primary" value="Valider" />
		  <?php /*</form>*/ ?>
	</div>
</div>
