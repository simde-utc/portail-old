<?php use_stylesheet("reservation.css") ?>

<?php include_component("reservation","insideMenu",array("param" => $param)) ?>

<?php if ($param == "salles"): ?>
	
	<?php include_component("reservation","salle",array("id" => $id, "form" => $form, "salles" => $salles)) ?>
	
<?php elseif ($param == "reservations"): ?>
	
	<?php include_component("reservation","reservation") ?>
	
<?php endif; ?>
