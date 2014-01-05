<?php use_stylesheet('event.css') ?>
<?php use_helper('Text') ?>
<?php use_helper('Date') ?>
<?php use_helper('Events') ?>

<h2><?php echo isset($asso) ? "Event de : " . $asso->getName() : "Liste des events" ?></h2>
<?php if (isset($asso) && $sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x08)): ?>
  <a href="<?php echo url_for('event/new') ?>">Créer un event</a>
<?php endif ?>

<ul id="event_list">
  <?php foreach ($events as $event) : ?>

    <li>
      <h3><?php echo $event->getName() . " - " . format_date($event->getStartDate(), 'f', 'fr') . " au " . format_date($event->getEndDate(), 'f', 'fr'); ?></h3>
      <?php echo event_from_asso_list($event) ;?>
      <php echo " le " . format_date($event->getCreatedAt(), 'f', 'fr') ?>  
      <?php if (isset($asso) && $sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x08)): ?>
        - <a href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>">Editer</a>
      <?php endif ?>
      <img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
      <div class="desc">
        <?php echo truncate_text($event->getDescription(), 256) ?>
        </br>
        <a class="link" href="<?php echo url_for('event/show/?id=' . $event->getId()) ?>">Lire la suite</a>
      </div>
    </li>

  <?php endforeach; ?>
</ul>
