<?php use_helper('Date') ?>
<?php //use_helper('Thumb') ?>
<?php //use_helper('Events') ?>


<div class="part" id="reservation">
  <h1>
    <?php if($reservation->getAsso()->getId()) echo $reservation->getAsso(); 
	else echo $reservation->getUserReserve()->getUsername();?>
  </h1>
  <div class="row-fluid">
        <p><i class="fa fa-calendar fa-2x fa-fw"></i>Le <?php echo format_date($reservation->getDate(), 'D', 'fr'); ?></p>
	<?php if($reservation->getAllday()) : ?>
		<p><i class="fa fa-clock-o fa-2x fa-fw"></i>Toute la journée</p>
	<?php else : ?>
		<p><i class="fa fa-clock-o fa-2x fa-fw"></i>De <?php echo format_date($reservation->getHeuredebut(), 't', 'fr') ?> à <?php echo format_date($reservation->getHeurefin(), 't', 'fr') ?></p>
	<?php endif; ?>
	<p><i class="fa fa-tag fa-2x fa-fw"></i><em><?php echo $reservation->getActivite(); ?></em></p>
	<p><i class="fa fa-home fa-2x fa-fw"></i><?php echo ucfirst($reservation->getSalle()); ?></p>
	<p><i class="fa fa-info-circle fa-2x fa-fw"></i>Créé par <a href="mailto:<?php echo $reservation->getUserReserve()->getEmailAddress() ?>"><?php echo $reservation->getUserReserve()->getUsername() ?></a>
	<?php 
		if($reservation->getAsso()->getId()) echo  " pour <a href=\"". url_for('assos_show', array('login' => $reservation->getAsso()->getLogin())) . "\">" . ucfirst($reservation->getAsso()) ."</a>" ; ?></p>
  </div>
	<?php if($reservation->getUserValide()->getId()) : ?>
		<p><i class="fa fa-info-circle fa-2x fa-fw"></i>Validée par <a href="mailto:<?php echo $reservation->getUserReserve()->getEmailAddress() ?>"><?php echo $reservation->getUserReserve()->getUsername() ?></a>
	<?php elseif($reservation->getEstvalide()) :
		echo "<p><i class=\"fa fa-info-circle fa-2x fa-fw\"></i>Validée automatiquement</p>";?>
	<?php else :
		echo "<p><i class=\"fa fa-info-circle fa-2x fa-fw\"></i>Non Validée</p>";?>
	<?php endif; ?>
  </div>
</div>
