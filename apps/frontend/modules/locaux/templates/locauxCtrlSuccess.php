<div class="part">
	<h1>Charte locaux</h1>
	<p> Blablabla Voici la charte locaux blabla</p>
	<div class="well">
		<h1>Récapitulatif de saisie:</h1>
		<p>Nom: <?php echo $sf_user->getGuardUser()->getLastName() ?></p>
		<p>Prénom: <?php echo $sf_user->getGuardUser()->getFirstName() ?></p>
		<p>Association: <?php echo $charte->getAsso()->getName() ?></p>
		<p>Accès demandés:
			<ul>
				<?php
				if ($charte->getPorteMde()==1) echo "<li>Porte de la MDE</li>";
				if ($charte->getBatA()==1) echo "<li>Batiment A</li>";
				if ($charte->getMdeComplete()==1) echo "<li>MDE complète</li>";
				if ($charte->getLocauxPic()==1) echo "<li>Locaux du PIC</li>";
				if ($charte->getBureauPolar()==1) echo "<li>Bureau du Polar</li>";
				if ($charte->getPermPolar()==1) echo "<li>Permanence du Polar</li>";
				if ($charte->getSallesMusique()==1) echo "<li>Salles de musique</li>";
				?> 
			</ul>
		</p>
		<p>Motif: <?php echo $charte->getMotif() ?></p>
		<p></p>

		<p>En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
		<p>
			<ul>
				<li>avoir pris connaissance de la charte et l'approuver</li>
			</ul>
		</p>
		<form method="post" action="<?php echo url_for('locaux_post', $charte)?>">
			<input type="text" name="check" /><br />
			<input type="hidden" name="id" value="<?php echo $charte->getId() ?>" />
			<input type="submit" class="btn btn-primary" value="Valider" />
		</form>
	</div>
</div>
