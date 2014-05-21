<?php include_partial("insideMenu",array("param" => $param)) ?>

<h4><?php echo link_to('Nouveau Creneau Off','reservation_creneauoff_new') ?></h4>

<h3>Gestion des creneaux off</h3>

<ul>
<?php foreach ($creneauoff as $cre): ?>

	<li><?php echo link_to($cre, 'reservation_creneauoff_show',array('date'=>$cre->getDate())) ?></li>

<?php endforeach; ?>
</ul>
