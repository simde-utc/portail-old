<div class="part">
      <form method="post" action="<?php echo url_for('locaux_post') ?>">
      <h1>Récapitulatif de saisie:</h1>
      <p>Nom: <?php echo $lastname ?></p>
      <p>Prénom: <?php echo $firstname ?></p>
    <?php foreach($assos as $asso): ?>
    <?php $asso_id=$asso->getId();
      if($asso_id==$_POST['asso_id']) {
      echo "<p>Association:";
      echo"<INPUT type='hidden' name='asso_id' value='".$_POST['asso_id']."'>";
      echo $asso->getName();
      echo "</p>"; /*Pas Beau mais j'arrive pas à faire la requete doctrine*/
    } ?>
    <?php endforeach; ?>
      <p>Accès demandés:
        <ul>
        <?php /*Attention ça pique aux yeux*/
          if (isset($_POST["porte_mde"]) && $_POST["porte_mde"]==1) echo "<li>Porte de la MDE</li><INPUT type='hidden' name='porte_mde' value='1'>";
          else echo "<INPUT type='hidden' name='porte_mde' value='0'>";
          if (isset($_POST["bat_a"]) && $_POST["bat_a"]==1) echo "<li>Batiment A</li><INPUT type='hidden' name='bat_a' value='1'>";
          else echo "<INPUT type='hidden' name='bat_a' value='0'>";
          if (isset($_POST["mde_complete"]) && $_POST["mde_complete"]==1) echo "<li>MDE complète</li><INPUT type='hidden' name='mde_complete' value='1'>";
          else echo "<INPUT type='hidden' name='mde_complete' value='0'>";
          if (isset($_POST["locaux_pic"]) && $_POST["locaux_pic"]==1) echo "<li>Locaux du PIC</li><INPUT type='hidden' name='locaux_pic' value='1'>";
          else echo "<INPUT type='hidden' name='locaux_pic' value='0'>";
          if (isset($_POST["bureau_polar"]) && $_POST["bureau_polar"]==1) echo "<li>Bureau du Polar</li><INPUT type='hidden' name='bureau_polar' value='1'>";
          else echo "<INPUT type='hidden' name='bureau_polar' value='0'>";
          if (isset($_POST["perm_polar"]) && $_POST["perm_polar"]==1) echo "<li>Permanence du Polar</li><INPUT type='hidden' name='perm_polar' value='1'>";
          else echo "<INPUT type='hidden' name='perm_polar' value='0'>";
          if (isset($_POST["salles_musique"]) && $_POST["salles_musique"]==1) echo "<li>Salles de musique</li><INPUT type='hidden' name='salles_musique' value='1'>";
          else echo "<INPUT type='hidden' name='salles_musique' value='0'>";
        ?> 
        </ul>
      </p>
      <p>Motif:</p>
      <p><?php echo $_POST["motif"] ?><?php echo"<INPUT type='hidden' name='motif' value='".$_POST['motif']."'>" ?> </p>
 
        <p>En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
        <p><ul>
          <li>avoir pris connaissance de la charte et l'approuver</li>
          </ul>
        </p>
        <input type="text" name="check" /><br />
        <input type="submit" class="btn btn-primary" value="Valider" />
      </form>
</div>