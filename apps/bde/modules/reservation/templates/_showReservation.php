<p><b>Qui ? : </b><?php echo $reservation->getUserReserve()->getFirstName()." ".$reservation->getUserReserve()->getLastName()." (".$reservation->getUserReserve()->getUsername().")" ?></p>
<p><b>Salle : </b><?php echo $reservation->getSalle() ?></p>
<p><b>Asso : </b><?php echo $reservation->getAsso() ?></p>
<p><b>Date : </b><?php echo date("j/n/Y",strtotime(str_replace('-','/', $reservation->getDate()))) ?></p>
<p><b>Heure Debut : </b><?php echo $reservation->getHeuredebut() ?></p>
<p><b>Heure Fin : </b><?php echo $reservation->getHeurefin() ?></p>
<p><b>est validée : </b><?php if($reservation->getEstvalide()) echo "oui"; else echo "non"; ?></p>
<br />
<?php if ($reservation->getCommentaire()): ?>
<p><b>Commentaire : </b><br /><?php echo $reservation->getCommentaire() ?></p>
<?php endif ?>
<br />
<br />
