<div class="part">
  <h1>Charte locaux</h1>
  <p> Blablabla Voici la charte locaux blabla</p>
    <div class="well">
      <form method="post" action="<?php echo url_for('locaux_create') ?>">
        <?php echo $form->renderHiddenFields(false) ?>
        <p>Pour quels lieux désirez-vous l'accès étendu?</p>
        <table>
			<tr>
				<td><?php echo $form['porte_mde']->renderlabel('Porte de la MDE ') ?></td>
                <td><?php echo $form['porte_mde'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['bat_a']->renderlabel('Batiment A ') ?></td>
                <td><?php echo $form['bat_a'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['mde_complete']->renderlabel('MDE complète ') ?></td>
                <td><?php echo $form['mde_complete'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['locaux_pic']->renderlabel('Locaux du Pic ') ?></td>
                <td><?php echo $form['locaux_pic'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['bureau_polar']->renderlabel('Bureau du Polar ') ?></td>
                <td><?php echo $form['bureau_polar'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['perm_polar']->renderlabel('Permanence du Polar') ?></td>
                <td><?php echo $form['perm_polar'] ?></td>
			</tr>
			<tr>
				<td><?php echo $form['salles_musique']->renderlabel('Salles de musique ') ?></td>
                <td><?php echo $form['salles_musique'] ?></td>
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
