<?php use_stylesheet('event.css') ?>
<?php use_helper('Date') ?>

<h2><?php $event->getName() ?> </h2>

<h3><?php echo $event->getName() ?> - <?php echo format_date($event->getStartDate(),'f','fr') . " au " . format_date($event->getEndDate(),'f','fr'); ?></h3>
		Créé par <?php echo $event->getAsso()->getName() ?> le <?php echo format_date($event->getCreatedAt(),'f','fr') ?>
    <br />
    Type: <?php echo $event->getType()->getName(); ?>
    <br />
    Lieu : <?php echo $event->getPlace(); ?>
    <br />
<!-- todo only if authorized -->
		- <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>
<br/>
<img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
<div class="desc">
  <?php echo html_entity_decode($event->getDescription(), ENT_QUOTES, "utf-8"); ?>
  </br>
</div>
