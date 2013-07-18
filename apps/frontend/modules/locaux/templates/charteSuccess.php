<div class="part">
  <h1>Charte locaux</h1>
  <p> Blablabla Voici la charte locaux blabla</p>
    <div class="well">
      <form method="post" action="<?php echo url_for('locaux_ctrl') ?>">
        <p>Pour quelle association désirez-vous signez la charte (vous devez être membre de l'association)</p>
        <select name="assoc_id"><!--Rendre automatique la mise en place des champs assoc-->
          <option value="1">BDE</option>
          <option value="2">SIMDE</option>
        </select>
        <br/>
        <br/>
        <p>Pour quels lieux désirez-vous l'accès étendu?</p>
        <INPUT type="checkbox" name="porte_mde" value="1">Porte de la MDE<br/>
        <INPUT type="checkbox" name="bat_a" value="1">Batiment A<br/>
        <INPUT type="checkbox" name="mde_complete" value="1">MDE complète<br/>
        <INPUT type="checkbox" name="locaux_pic" value="1">Locaux du PIC<br/>
        <INPUT type="checkbox" name="bureau_polar" value="1">Bureau du Polar<br/>
        <INPUT type="checkbox" name="perm_polar" value="1">Permanence du Polar<br/>
        <INPUT type="checkbox" name="salles_musique" value="1">Salles de musique<br/>

        <br/>
        <p>Entrez le motif de la demande ci dessous:</p>
        <textarea  type="text" name="motif" rows="5" cols="500">
        </textarea>
        
        <br/>
        <br/>
        <p>En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
        <p><ul>
          <li>avoir pris connaissance de la charte ci-dessus et l'approuver</li>
          </ul>
        </p>
        <input type="text" name="check" /><br />
        <input type="submit" class="btn btn-primary" value="Valider" />
      </form>
    </div>
</div>