<div id="FormShape">
<form action="<?php echo url_for('reservation_process_form') ?>" method="post" >
<div id=formResa1>

 <legend> Réservation: </legend>
 <table class=formTab>
    <tr>
      <td class="CaseLabel">Date:</td> <td><?php echo $form['id_salle']->render();echo $form['date']->render(); ?></td>
    </tr>
    <tr>
      <td class="CaseLabel">De</td><td> <?php echo $form['heuredebut']->render() ?> à <?php echo $form['heurefin']->render() ?></td>
    </tr> 
    <tr>
      <td class="CaseLabel"> Association:</td><td> <?php echo $form['id_asso']->render()?></td>
    </tr>
    <!--<tr>
      <td class="CaseLabel">Pôle concerné :</td><td> Auto  TO DO <br/></td>
    </tr>-->
    <tr>
      <td class="CaseLabel">Type salle :</td><td> Champ rempli automatiquement, une fois les données rentrées dans la BDD <br/></td>
    </tr>
    <tr>
      <td class="CaseLabel">Infos salle :</td><td> Champ rempli automatiquement, une fois les données rentrées dans la BDD <br/></td>
    </tr>
</table>
</div>

<div id="sep"></div>

<div id=formResa2>
    <?php echo $form['nbPers']->render() ?>

    <label for="utilise">Activité: </label>
   <select name="utilise" id="utilise">
    <option value="toujours"> Liste</option>
    <option value="parfois"> à déterminer</option>
    <option value="jamais"> par BDE</option>
   </select>

        <?php echo $form['message']->renderRow() ?>
   
    <p>
 <input type="submit" name="submit" value="Envoyer" />
 <input type="button" value="Annuler" onclick="$('#FormShape').fadeOut();" />
 </p>
</div>

</form>
</div>
