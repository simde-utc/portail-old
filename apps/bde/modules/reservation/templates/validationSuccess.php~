<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<?php if($id == -1): ?>

	<h3>Listes des reservations non validées</h3>

	<?php foreach ($reservations as $reservation): ?>

		<pre>
		<?php echo link_to ($reservation->getDate()." - ".$reservation->getAsso(), "reservation_validation_id", array('id'=>$reservation->getId())) ?>
		</pre>

	<?php endforeach; ?>

<?php else: ?>

	<h3>Reservation non validée</h3>

	<?php $user = sfGuardUserTable::getInstance()->getUserById($reservation->getIdUserReserve())->execute()[0] ?>
	
	<p><b>Qui ? : </b><?php echo $user->getFirstName()." ".$user->getLastName()." (aka ".$user->getUsername().")" ?></p>
	<?php if ($reservation->getAsso()) :?>
	
		<p><b>Asso : </b><?php echo $reservation->getAsso() ?></p>
	
	<?php endif; ?>
	<p><b>Date : </b><?php echo $reservation->getDate() ?></p>
	<p><b>Heure Debut : </b><?php echo $reservation->getHeuredebut() ?></p>
	<p><b>Heure Fin : </b><?php echo $reservation->getHeurefin() ?></p>
	<p><b></b></p>
	<p><b>est validée : </b><?php if($reservation->getEstvalide()) echo "oui"; else echo "non"; ?></p>	

	<form action="<?php echo url_for('reservation_validation_valid',array('id'=>$id)) ?>" method="post">
	
		<textarea rows="4" cols="50" name="comment">Your comment here</textarea>
	
		<input type="submit" name="accepter" value="Accepter" />
		<input type="submit" name="refuser" value="Refuser" />
	
	</form>

<?php endif; ?>
