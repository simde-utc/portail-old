<p><b>Date</b> : <?php echo $creneauoff ?></p>

<p><b>Salles</b></p>

<ul>
<?php foreach ($creneauoff->getSalleCreneauOff() as $salle): ?>

	<li><?php echo $salle->getSalle() ?></li>
	
<?php endforeach ?>
</ul>
