<?php use_helper('Date') ?>
<h1>Nos événements</h1>
<div id="events">
  <?php if ($events->count() > 0): ?>
    <div id="event_list">
      <?php foreach ($events as $event) : ?>
        <div class="event" style="background: <?php echo $event->getPole()->getCouleur() ?>">
			<img src="<?php echo $event->getAffiche() ?>" alt="<?php echo $event->getType() ?>" /><br />
			<h2><?php echo $event->getName() ?></h2>
			Par <?php echo $event->getAsso()->getName() ?><br />
			Le <?php echo format_date($event->getStartDate(), 'd MMMM à HH:mm', 'fr'); ?>
			<p class="desc">
            <?php echo truncate_text($event->getDescription(), 256) ?>
            <a class="link" href="<?php echo url_for('event_show',$event) ?>">En savoir plus</a>
            </p>
          <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x08)): ?>
            <div class="actions">
              <a href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>">Editer</a>
            </div>
          <?php endif ?>
        </div>
      <?php endforeach; ?>
    </div>
	<hr class="clear"/>
	<a class="more"> >>> Voir tous les evenements</a>
  <?php else: ?>
    Cette association n'a pas encore proposé d'événement.
  <?php endif ?>
</div>