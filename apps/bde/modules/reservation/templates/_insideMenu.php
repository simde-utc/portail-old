<ul id="menuBde">
	<?php if ($param == "salles"): ?>
	<li><span>Gestion des salles</span></li>
	<?php else: ?>
	<li><a href="<?php echo url_for('reservation_salles') ?>">Gestion des salles</a></li>
	<?php endif; ?>
	
	<?php if ($param == "reservations"): ?>
	<li><span>Validation des reservations</span></li>
	<?php else: ?>
	<li><a href="<?php echo url_for('reservation_reservations') ?>">Validation des reservations</a></li>
	<?php endif; ?>
	
	<li><a href="#">Modification</a></li>
	<li><a href="#">Modification</a></li>
</ul>


