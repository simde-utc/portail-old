<?php use_stylesheet('event.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo isset($asso) ? "Event de : ".$asso->getName() : "Liste des events" ?></h2>
<!-- todo only if authorized -->
<a href="<?php echo url_for('event/new') ?>">Créer un event</a>

<ul id="event_list">
  <?php foreach($events as $event) : ?>

    <li>
      <h3><?php echo $event->getName() ?></h3>
  		Créé par <?php echo $event->getAsso()->getName() ?> le <?php echo $event->getCreatedAt() ?>  
      <!-- todo only if authorized -->
  		- <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>

      <img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
      <div class="desc">
        <?php echo truncate_text($event->getDescription(),256) ?>
        </br>
        <a class="link" href="<?php echo url_for('event/show/?id='.$event->getId()) ?>">Lire la suite</a>
      </div>
    </li>

  <?php endforeach; ?>
</ul>
