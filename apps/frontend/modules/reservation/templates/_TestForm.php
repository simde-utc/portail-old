<div id="FormShape">
<form action="toto.php" method="post" >
<div id=formResa1>

 <legend> Réservation: </legend>
    <?php echo $form['date']->renderRow() ?>
    <?php echo $form['heuredebut']->renderRow() ?>
    <?php echo $form['heurefin']->renderRow() ?>
    <?php echo $form['id_asso']->renderRow() ?>
    <p> Pôle concerné : Auto <br/></p>

</div>

<div id="sep"></div>

<div id=formResa2>
    <p> Infos sur la salle: </p>
    <p>Type de salle: Auto<br/></p>

    <?php echo $form['nbPers']->renderRow() ?>

    <label for="utilise">Activité: </label>
   <select name="utilise" id="utilise">
    <option value="toujours"> Liste</option>
    <option value="parfois"> à déterminer</option>
    <option value="jamais"> par BDE</option>
   </select>

        <?php echo $form['message']->renderRow() ?>
   
    <p>
 <input type="submit" value="Envoyer" />
 <input type="button" value="Annuler" onclick="$('#FormShape').fadeOut();" />
 </p>
</div>

</form>
</div>
