<div class="gallery-info">
  <?php if(!$fulldesc): ?>
    <a href="<?php echo url_for('galerie/show?id='.$galerie_photo->getId()) ?>">
    <?php endif ?>
    <h3>
    <?php echo $galerie_photo->getTitle() ?>
    </h3>
    <?php if(!$fulldesc): ?>
    </a>
  <?php endif ?>
  <?php if($fulldesc): ?>
    <p>
      Événement : 
      <a href="<?php echo url_for('event_show', $galerie_photo->getEvent()) ?>">  
        <?php echo $galerie_photo->getEvent() ?>
      </a>
    </p>
    <p><?php echo getAssoNameForEvent($galerie_photo->getEvent())?></p>
  <?php endif ?>
  <p><?php echo $galerie_photo->getDescription() ?></p>
</div>
