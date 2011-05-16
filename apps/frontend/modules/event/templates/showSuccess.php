<?php use_stylesheet('event.css') ?>

<h2><?php $event->getName() ?> </h2>

<h3><?php echo $event->getName() ?></h3>
		Publié par <?php echo $event->getAsso()->getName() ?> le <?php echo $event->getCreatedAt() ?>  
<!-- todo only if authorized -->
		- <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>
<br/>
<img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
<div class="desc">
  <?php echo html_entity_decode($event->getDescription(), ENT_QUOTES, "utf-8"); ?>
  </br>
</div>
