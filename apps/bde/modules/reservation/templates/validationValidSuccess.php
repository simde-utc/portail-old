<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<p><?php echo link_to ('<< retour', 'reservation_validation') ?></p>


<?php if($valider): ?>

	<h3>La reservation a été validée</h3>
	
	

<?php else: ?>

	<h3>Reservation a été refusée</h3>


<?php endif; ?>

	<h4>Info sur la réservation :</h4>

<?php $user = sfGuardUserTable::getInstance()->getUserById($reservation->getIdUserReserve())->execute()[0] ?>
	
	<p><b>Qui ? : </b><?php echo $user->getFirstName()." ".$user->getLastName()." (".$user->getUsername().")" ?></p>
	<?php if ($reservation->getAsso()) :?>
	
		<p><b>Asso : </b><?php echo $reservation->getAsso() ?></p>
	
	<?php endif; ?>
	<p><b>Date : </b><?php echo $reservation->getDate() ?></p>
	<p><b>Heure Debut : </b><?php echo $reservation->getHeuredebut() ?></p>
	<p><b>Heure Fin : </b><?php echo $reservation->getHeurefin() ?></p>
	<p><b></b></p>
	<p><b>est validée : </b><?php if($reservation->getEstvalide()) echo "oui"; else echo "non"; ?></p>
	
	
	<h4>Mail envoyé :</h4>

	<p><?php echo nl2br($mail) ?></p>


