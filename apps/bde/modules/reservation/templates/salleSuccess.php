<?php include_partial("insideMenu",array("param" => $param)) ?>

<h4><?php echo link_to ('Nouvelle salle', 'reservation_salle_new') ?></h4>

<h3>Liste des salles</h3>
<div id="table_salle">
<?php foreach ($salles as $salle): ?>

  <p>
    <span class="name"><?php echo ucfirst ($salle->getName()) ?></span>
    <span><?php echo link_to ('Edit', 'reservation_salle_update', array ('id' => $salle->getId())) ?></span>
    <span><?php echo link_to ('Delete', 'reservation_salle_delete', array ('id' => $salle->getId())) ?></span>
  </p>
  
<?php endforeach; ?>
</div>
