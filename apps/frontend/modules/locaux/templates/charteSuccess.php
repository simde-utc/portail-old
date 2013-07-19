<div class="part">
  <h1>Charte locaux</h1>
  <p> Blablabla Voici la charte locaux blabla</p>
    <div class="well">
      <?php /*<form method="post" action="<?php echo url_for('locaux_ctrl') ?>">
        <p>Pour quelle association désirez-vous signez la charte (vous devez être membre de l'association)</p>
        <select name="asso_id">
          <?php foreach ($assos as $asso): ?>
          <option value="<?php echo $asso->getId() ?>"><?php echo $asso->getName() ?></option>
          <?php endforeach; ?>
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
        <input type="submit" class="btn btn-primary" value="Valider" />
      </form> */ ?>
      <form method="post" action="<?php echo url_for('locaux_ctrl') ?>">
        <p>Pour quelle association désirez-vous signez la charte (vous devez être membre de l'association) ?</p>
        <table>
			<tr>
				<th><?php echo $form['asso_id']->renderlabel('Association:') ?></th><td><?php echo $form['asso_id'] ?></td>
			</tr>
        </table>
        <br />
        <p>Pour quels lieux désirez-vous l'accès étendu?</p>
        <table>
			<tr>
				<td><?php echo $form['porte_mde']->renderlabel('Porte de la MDE ') ?></td><td><?php echo $form['porte_mde'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['bat_a']->renderlabel('Batiment A ') ?></td><td><?php echo $form['bat_a'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['mde_complete']->renderlabel('MDE complète ') ?></td><td><?php echo $form['mde_complete'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['locaux_pic']->renderlabel('Locaux du Pic ') ?></td><td><?php echo $form['locaux_pic'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['bureau_polar']->renderlabel('Bureau du Polar ') ?></td><td><?php echo $form['bureau_polar'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['perm_polar']->renderlabel('Permanence du Polar') ?></td><td><?php echo $form['perm_polar'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['salles_musique']->renderlabel('Salles de musique ') ?></td><td><?php echo $form['salles_musique'] ?></td>
			</tr>
        </table>
        <br />
        <p>Entrez le motif de la demande ci dessous:</p>
        <?php echo $form['motif'] ?>
        <br/>
        <input type="submit" class="btn btn-primary" value="Valider" />
	  </form>
    </div>
</div>
