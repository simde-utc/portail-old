<div class="part">
	<h1>Charte d'accès étendu</h1>
	<h2>Charte d’accès étendu à la Maison des Etudiants</h2>
  
	<p> L’accès à la Maison des Etudiants <u><font color="#AA0000">(MDE) EST LIBRE DE 7 H30 À 23H 00 DU LUNDI AU VENDREDI, HORS
	PÉRIODE DE VACANCES , ET LES WEEK - ENDS ET JOURS FÉRIÉ. P OUR LE BÂTIMENT A, LES HORAIRES SONT
	LES MÊMES QU ’INDIQUÉES DANS LE RI DE L ’UTC.</font></u></p>

	<p>L’activation de votre badge sésame (carte d’étudiant) pour l’accès étendu vous garantira l’accès à la MDE
	(semaine, week-end et vacances) suivant le groupe d’accès demandé (un seul groupe d'accès possible).</p>
	
	<p>
	L’étudiant détenteur d’un badge sésame lui donnant l’accès étendu à la MDE s’engage à :
		<ul> 
		<li>Ne pas prêter son badge sésame,</li>
		<li>Signaler toute perte de son badge sésame auprès du BDE-UTC et de l’UTC dans les meilleurs
		délais,</li>
		<li>Pénétrer dans la MDE uniquement dans le cadre de l’activité associative,</li>
		<li>Vérifier que tous les accès (portes et fenêtres) sont bien fermés à son départ,</li>
		<li>Ne pas introduire dans le local de matériel dangereux ou illicite, ou des personnes susceptibles de
		troubler l'activité de la MDE ou de porter préjudice à son matériel,</li>
		<li>Respecter les biens et les moyens collectifs mis à disposition, ne pas les détériorer,</li>
		<li>Rendre en état les salles du bâtiment A pour permettre aux cours de se dérouler sans problème,</li>
		<li>Signaler, dans les meilleurs délais, au BDE-UTC (MDE, local E300 – 03 44 23 43 71), et à
		l’administration (contacter le gardien de l’UTC) tout problème relatif aux locaux ou à la sécurité,</li>
		</ul>
	</p>

	<p>D’autre part, l’étudiant présent dans la MDE en dehors des horaires d’ouverture libre doit veiller à sa
	sécurité. En effet, le BDE-UTC n’assure pas de permanence durant ces périodes. Il doit avoir conscience du
	privilège de pouvoir accéder à la MDE en dehors des accès libres face à d’autres étudiants à l’accès limité,
	et doit par conséquent éviter tout incident qui pourrait entraîner la fermeture de la MDE.</p>

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
