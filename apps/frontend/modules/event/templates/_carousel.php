<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>

<!-- Carousel from : http://tympanus.net/codrops/2011/08/16/circular-content-carousel/ -->
<div id="calendrier">
  <h1>Prochains événements</h1>
  <div class="wrap ca-wrapper">
    <?php foreach($events as $event) : ?>
      <div class="event ca-item">
          <a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo showThumb($event->getAffiche(), 'events', array('width'=>112, 'height'=>112), 'center') ?></a>
          <h3><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getName() ?></a><br /></h3>
          <p><?php echo $event->getSummary() ?></p>
          <p>Par <a href="<?php echo url_for('asso/show?login='.$event->getAsso()->getLogin()) ?>" title="<?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a><br />
          <p><?php echo format_date($event->getStartDate(),"D",'fr') ?>, <?php echo format_date($event->getStartDate(),"t",'fr') ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script>
  $('#calendrier').contentcarousel();
</script>
