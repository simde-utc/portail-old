<div class="part">
  test??????





      <form method="post" action="<?php echo url_for('locaux_ctrl') ?>">
        <p>En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
        <p><ul>
          <li>avoir pris connaissance de la charte et l'approuver</li>
          </ul>
        </p>
        <input type="text" name="check" /><br />
        <input type="submit" class="btn btn-primary" value="Valider" />
      </form>
</div>