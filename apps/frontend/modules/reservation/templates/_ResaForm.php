<?php if (!$ok): ?> 

<div id="FormShape">
<form action="<?php echo url_for('reservation'),array('id' => $idSalle) ?>" method="post" >
<div id=formResa1>

 <legend> Réservation: </legend>
 <table class=formTab>
    <tr>
      <td class="CaseLabel">Date:</td> <td><?php echo $form['id_salle']->render(); echo $form['date']->render(); ?></td>
    </tr>
    <tr>
      <td class="CaseLabel">De</td><td> <?php echo $form['heuredebut']->render() ?> à <?php echo $form['heurefin']->render() ?></td>
    </tr>
    <!-- Faire test si salle pôle ou salle BDE pour voir si besoin de demander l'asso-->		
    <tr>
      <td class="CaseLabel"> Association:</td><td> <?php echo $form['id_asso']->render()?></td>
    </tr>
    <tr>
      <td class="CaseLabel">Activite :</td><td> <?php echo $form['activite']->render()?></td>
    </tr>
</table>
</div>

<div id="sep"></div>

<div id=formResa2>
    <p> Nombre Personnes : </p><?php echo $form['nbPers']->render() ?>

    <?php echo $form['message']->renderRow() ?>
   
    <p>
 <input type="submit" name="submit" value="Envoyer" />
 <input type="button" value="Annuler" onclick="$('#FormShape').fadeOut();" />
 </p>
</div>

</form>
</div>
	
<?php else: ?>

	<p>Réservation ajoutée avec succès !</p>

	//<?php include_partial("showSalle",array('salle'=>$salle_modif)) ?>
	

<?php endif; ?>






