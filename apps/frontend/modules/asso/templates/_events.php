<div id="events">
  <h3>Événement de <?php echo $asso->getName() ?></h3>
  <?php if($events->count() > 0): ?>
    <ul id="event_list">
      <?php foreach($events as $event) : ?>
        <h4><?php echo $event->getName() ?></h4>
        Publié par <?php echo $event->getAsso()->getName() ?> le <?php echo $event->getCreatedAt() ?>  
        <!-- todo only if authorized -->
        - <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>

        <img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
        <div class="desc">
          <?php echo html_entity_decode(truncate_text($event->getDescription(),256)) ?>
          </br>
          <a class="link" href="<?php echo url_for('event_show',$event) ?>">Lire la suite</a>
        </div>

      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Cette association n'a pas encore proposé d'événement.
  <?php endif ?>
</div>