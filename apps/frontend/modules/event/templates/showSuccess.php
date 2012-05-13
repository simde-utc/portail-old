<?php use_stylesheet('event.css') ?>
<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>

<div class="part">
  <h1>
    <?php echo $event->getName() ?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x04)): ?>
      <span class="titleaction"><i class="icon-edit icon-white"></i> <a href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>">Éditer</a></span>
    <?php endif ?>
  </h1>
  
  <?php if($event->getAffiche()): ?>
    <?php echo showThumb($event->getAffiche(), 'events', array('width'=>350, 'height'=>250, 'class'=>'affiche'), 'scale') ?><br />
  <?php endif; ?>

  <p>Du <?php echo format_date($event->getStartDate(), 'f', 'fr') ?> au <?php echo format_date($event->getEndDate(), 'f', 'fr') ?></p>

  <p>
    Créé par <a href="<?php echo url_for('assos_show',$event->getAsso())?>" title="Voir la page de <?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a><br />
    Type : <?php echo $event->getType()->getName(); ?><br />
    Lieu : <?php echo $event->getPlace(); ?>
  </p>
  <p><?php echo $event->getSummary() ?></p>
  <p><?php echo $event->getDescription() ?></p>
</div>