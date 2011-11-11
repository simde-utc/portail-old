<h1>événements</h1>
<?php foreach($events as $event): ?>
  <div class="event" style="background: <?php echo $event->getPole()->getCouleur() ?>">
    <img src="<?php echo $event->getAffiche() ?>" alt="<?php echo $event->getType() ?>" /><br />
    <h2><?php echo $event->getName() ?> - <?php echo $event->getAsso()->getName() ?> - Du <?php echo $event->getStartDate() ?> au <?php echo $event->getEndDate() ?></h2>
    <div class="event_content">
      <?php echo $event->getDescription() ?>
    </div>
  </div>
<?php endforeach ?>
<hr class="clear"/>
<a class="more"> >>> Voir tous les evenements</a>