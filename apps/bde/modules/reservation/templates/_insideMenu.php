<?php use_stylesheet("reservation.css") ?>

<ul id="menuBde">
	<?php if ($param == "salle"): ?>
	<li><span>Gestion des salles</span></li>
	<?php else: ?>
	<li><a href="<?php echo url_for('reservation_salle') ?>">Gestion des salles</a></li>
	<?php endif; ?>
	
	<?php if ($param == "validation"): ?>
	<li><span>Validation des reservations</span></li>
	<?php else: ?>
	<li><a href="<?php echo url_for('reservation_validation') ?>">Validation des reservations</a></li>
	<?php endif; ?>
	
	<li><a href="#">Modification</a></li>
	<li><a href="#">Modification</a></li>
</ul>

