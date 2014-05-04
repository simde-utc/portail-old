<h3>Reservations</h3>

<?php foreach ($reservations as $reservation): ?>

	<pre>
	<?php echo link_to ($reservation->getDate()." - ".$reservation->getAsso(),
								"",
								 ?>
	</pre>

<?php endforeach; ?>

