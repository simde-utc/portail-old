<?php include_partial("insideMenu",array("param" => $param)) ?>

<h3>Creneau off</h3>

<h4><?php echo link_to('<< retour','reservation_creneauoff') ?></h4>

<?php include_partial('showCreneauOff', array('creneauoff' => $creneauoff)) ?>


<?php if(!isset($del)): ?>
	<form action="<?php echo url_for('reservation_creneauoff_show',array('date'=>$date)) ?>" method="post">

		<input type="submit" name="delete" value="Supprimer" />

	</form>
<?php else: ?>
	<p>Ce creneau a été supprimé</p>
<?php endif ?>

