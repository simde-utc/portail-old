<?php use_helper('Date') ?>

<!-- Carousel from : http://tympanus.net/codrops/2011/08/16/circular-content-carousel/ -->
<div id="calendrier">
  <h1>Calendrier des associations</h1>
  <div class="wrap ca-wrapper">
    <?php foreach($events as $event) : ?>
      <div class="event ca-item">
          <img src="<?php echo $event->getAffiche_prefixed() ?>" alt="" width="112" height="112" />
          <h2><?php echo $event->getName() ?></h2>
          Par <a href="<?php echo url_for('asso/show?login='.$event->getAsso()->getLogin()) ?>" title="<?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a><br />
          <h3><?php echo format_date($event->getStartDate(),"D",'fr') ?></h3>
          <span class="infos">
            Heure de Début : <?php echo format_date($event->getStartDate(),"t",'fr') ?><br />
            Heure de Fin : <?php echo format_date($event->getEndDate(),"t",'fr') ?><br />
            Lieu
          </span>
          <a href="<?php echo url_for('event/show?id='.$event->getId()) ?>" class="more">En savoir plus</a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script>
  $('#calendrier').contentcarousel();
</script>
