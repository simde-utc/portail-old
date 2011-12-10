<div id="events">
  <?php if($events->count() > 0): ?>
    <div id="event_list">
      <?php foreach($events as $event) : ?>
        <div class="event">
          <h3><?php echo $event->getName() ?></h3>
          Publié par <?php echo $event->getAsso()->getName() ?> le <?php echo $event->getCreatedAt() ?>  
          <p class="desc">
            <?php echo html_entity_decode(truncate_text($event->getDescription(),256)) ?>
            <a class="link" href="<?php echo url_for('event_show',$event) ?>">Lire la suite</a>
          </p>
          <div class="actions">
            <!-- todo only if authorized -->
            <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    Cette association n'a pas encore proposé d'événement.
  <?php endif ?>
</div>