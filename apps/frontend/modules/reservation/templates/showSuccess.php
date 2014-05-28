<?php use_helper('Date') ?>
<?php //use_helper('Thumb') ?>
<?php //use_helper('Events') ?>


<div class="part" id="reservation">
  <h1>
    <?php echo $reservation->getAsso() ?>
  </h1>
  <div class="row-fluid">
        <p><i class="fa fa-calendar fa-2x fa-fw"></i>Le <?php echo format_date($reservation->getDate(), 'D', 'fr'); ?></p>
	<p><i class="fa fa-clock-o fa-2x fa-fw"></i>De <?php echo format_date($reservation->getHeuredebut(), 't', 'fr') ?> à <?php echo format_date($reservation->getHeurefin(), 't', 'fr') ?></p>
	<p><i class="fa fa-map-marker fa-2x fa-fw"></i><?php echo ucfirst($reservation->getSalle()); ?></p>
	<p><i class="fa fa-home fa-2x fa-fw"></i>Créé par <a href="<?php echo url_for('profile_show', array('username' => $reservation->getUserReserve()->getUsername() ))?>"><?php echo $reservation->getUserReserve()->getUsername(); ?></a> pour <a href="<?php echo url_for('assos_show', array('login' => $reservation->getAsso()->getLogin()))?>"><?php echo ucfirst($reservation->getAsso()) ;?></a></p>
  </div>

</div>
