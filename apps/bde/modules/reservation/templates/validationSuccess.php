<?php include_partial("insideMenu",array("param" => $param)) ?>

<?php if($id == -1): ?>

	<h3>Listes des reservations non validées</h3>

	<?php foreach ($reservations as $reservation): ?>

		<pre>
		<?php if ($reservation->getAsso()): ?>
		
		   <?php echo link_to ($reservation->showDate()." - ".$reservation->getUserReserve(), "reservation_validation_id", array('id'=>$reservation->getId())) ?>
		
		<?php else: ?>
		
		  <?php echo link_to ($reservation->showDate()." - ".$reservation->getAsso()->getName(), "reservation_validation_id", array('id'=>$reservation->getId())) ?>
		
		<?php endif; ?>
		
		
		</pre>

	<?php endforeach; ?>

<?php else: ?>

	<p><?php echo link_to ('<< retour', 'reservation_validation') ?></p>

	<h3>Reservation non validée</h3>
	
	<?php include_partial("showReservation",array("reservation" => $reservation)) ?>

	<form action="<?php echo url_for('reservation_validation_valid',array('id'=>$id)) ?>" method="post">
	
		<textarea rows="4" cols="50" name="commentaire" placeholder="Your comment here"></textarea>
	
		<input type="submit" name="accepter" value="Accepter" />
		<input type="submit" name="refuser" value="Refuser" />
	
	</form>

<?php endif; ?>
