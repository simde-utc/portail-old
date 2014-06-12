<?php include_partial("insideMenu",array("param" => $param)) ?>

<?php use_javascript("jscolor/jscolor.js") ?>

<h2>Nouvelle salle</h2>

<p><?php echo link_to ('<< retour', 'reservation_salle') ?></p>

<?php if (!isset($salle)): ?>

	<form action="<?php echo url_for('reservation_salle_new') ?>" method="post">

		<?php echo $form ?>
		<br />
		<input type="submit" />

	</form>
	
<?php else: ?>


	<?php include_partial("showSalle",array("salle" => $salle)) ?>
	

<?php endif; ?>
