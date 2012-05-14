<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<h1>Derniers événements ajoutés</h1>
<div id="events">
  <?php if($events->count() > 0): ?>
    <div id="event_list">
      <?php foreach($events as $event) : ?>
        <div class="event" style="background: <?php echo $event->getPole()->getCouleur() ?>">
          <a href="<?php echo url_for('event_show', $event) ?>"><?php echo showThumb($event->getAffiche(), 'events', array('width'=>160, 'height'=>100), 'center') ?></a><br />
          <h2><a href="<?php echo url_for('event_show', $event) ?>"><?php echo $event->getName() ?></a></h2>
          Par <a href="<?php echo url_for('assos_show',$event->getAsso())?>" title="Voir la page de <?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a><br />
          Le <?php echo format_date($event->getStartDate(), 'd MMMM à HH:mm', 'fr'); ?>
          <p class="desc">
            <?php echo $event->getSummary() ?>
          </p>
          <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x08)): ?>
            <div class="actions">
                <i class="icon-edit icon-white"></i> <a href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>">Éditer</a>
            </div>
          <?php endif ?>
        </div>
      <?php endforeach; ?>
    </div>
    <hr class="clear"/>
  <?php else: ?>
    Cette association n'a pas encore proposé d'événement.
  <?php endif ?>
</div>