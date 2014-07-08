<?php include_partial("insideMenu",array("param" => $param)) ?>

<p><?php echo link_to ('<< retour', 'reservation_validation') ?></p>


<?php if($valider): ?>

	<h3>La reservation a été validée</h3>
	
	

<?php else: ?>

	<h3>Reservation a été refusée</h3>


<?php endif; ?>

	<h4>Info sur la réservation :</h4>
	
	<?php include_partial("showReservation",array("reservation" => $reservation,"user"=>$user)) ?>
	
	<h4>Mail envoyé :</h4>

	<p><?php echo nl2br($mail) ?></p>



