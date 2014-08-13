  <div id="FormShape">
     <form action="<?php echo url_for('reservation_salle',array('id' => $idSalle)) ?>" method="POST" > 
  <?php echo $form->renderHiddenFields()?>
  <?php echo $form->renderGlobalErrors()?>

  <div id=formResa1>

    <legend> Nouvelle réservation: </legend>

    <p><?php echo $form['date']->renderRow()?></p>
    <p><?php echo $form['heuredebut']->renderLabel() ?><?php echo $form['heuredebut']->renderError() ?><?php echo $form['heurefin']->renderError() ?><?php echo $form['heuredebut']->render() ?><?php echo ' à '.$form['heurefin']->render() ?></p>
    <p>Jour entier(demande exceptionnelle): <?php echo $form['allday']->render()?></p>
    <p><?php echo $form['id_asso']->renderRow()?></p>

  </div>

  <div id="sep"></div>

  <div id=formResa2>

      <p><?php echo $form['activite']->renderRow()?></p>
      <?php echo $form['commentaire']->renderRow() ?>
    
      <p>
  <input type="submit" name="submit" value="Envoyer" />
  <input type="button" value="Annuler" onclick="$('#FormShape').fadeOut();" />
      </p>
  </div>
    </form>
 </div>
