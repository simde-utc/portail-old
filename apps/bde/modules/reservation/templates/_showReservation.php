<p><b>Qui ? : </b><?php echo $reservation->getUserReserve()->getFirstName()." ".$reservation->getUserReserve()->getLastName()." (".$reservation->getUserReserve()->getUsername().")" ?></p>
<p><b>Salle : </b><?php echo $reservation->getSalle() ?></p>
<?php if ($reservation->getAsso()->getName()): ?>
  <p><b>Asso : </b><?php echo $reservation->getAsso() ?></p>
<?php endif ?>
<p><b>Activité : </b><?php echo $reservation->getActivite() ?></p>
<p><b>Date : </b><?php echo $reservation->showDate() ?></p>
<?php if (!$reservation->getAllday()): ?>
  <p><b>Heure Debut : </b><?php echo $reservation->getHeuredebut() ?></p>
  <p><b>Heure Fin : </b><?php echo $reservation->getHeurefin() ?></p>
<?php endif ?>
<p><b>Toute la journée : </b><?php if($reservation->getAllday()) echo "oui"; else echo "non"; ?></p>
<p><b>Est validée : </b><?php if($reservation->getEstvalide()) echo "oui"; else echo "non"; ?></p>
<br />
<?php if ($reservation->getCommentaire()): ?>
<p><b>Commentaire : </b><br /><?php echo $reservation->getCommentaire() ?></p>
<?php endif ?>
<br />
