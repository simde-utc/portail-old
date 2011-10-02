<?php use_stylesheet('jquery.jscrollpane.css') ?>
<?php use_stylesheet('carousel.css') ?>

<?php use_javascript('jquery.easing.1.3.js') ?>
<?php use_javascript('jquery.mousewheel.js') ?>
<?php use_javascript('jquery.contentcarousel.js') ?>

<?php use_helper('Text') ?>
<?php use_helper('Date') ?>

<!-- Carousel from : http://tympanus.net/codrops/2011/08/16/circular-content-carousel/ -->
<div id="ca-container" class="ca-container">
  <div class="ca-wrapper">
<?php foreach($events as $event) : ?>
    <div class="ca-item">
      <div class="ca-item-main">
        <!--<img class="ca-icon" src=""/>-->
        <h3><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>" title="Plus d'infos"><?php echo $event->getName() ?></a></h3>
        <h3 class="ca-meta">par <a href="<?php echo url_for('asso/show?login='.$event->getAsso()->getLogin()) ?>" title="<?php echo $event->getAsso()->getName() ?>"><?php echo $event->getAsso()->getName() ?></a></h3>
        <h3 class="ca-meta"><?php echo format_date($event->getStartDate(), "d/M/y") ?> à <?php echo format_date($event->getStartDate(), "H:m") ?></h3>
        <?php if($event->getPlace()) : ?>
          <h3 class="ca-meta"><?php echo $event->getPlace() ?></h3>
        <?php endif; ?>
        <a href="<?php echo url_for('event/show?id='.$event->getId()) ?>" title="Plus d'infos" class="ca-plus">en savoir plus</a>
		  </div>
    </div>
<?php endforeach; ?>
  </div>
</div>

<script>
			$('#ca-container').contentcarousel();
</script>

			
