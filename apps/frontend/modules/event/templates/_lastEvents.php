<?php use_helper('Date'); ?>
<?php use_helper('Thumb') ?>
<h1>événements</h1>
<?php foreach($events as $event): ?>
  <div class="event" style="background: <?php echo $event->getPole()->getCouleur() ?>">
    <a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo showThumb($event->getAffiche(), 'events', array('width'=>160, 'height'=>100), 'center') ?></a><br />
    <h2><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getName() ?></a></h2>
    Par <?php echo $event->getAsso()->getName() ?><br />
    Le <?php echo format_date($event->getStartDate(), 'd MMMM à HH:mm', 'fr'); ?>
    <div class="event_content">
      <?php echo $event->getDescription() ?>
    </div>
  </div>
<?php endforeach ?>
<hr class="clear"/>
<a class="more"> >>> Voir tous les événements</a>