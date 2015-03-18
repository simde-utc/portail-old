<?php
  use_javascript("jquery-ui-1.8.12.custom.min.js");
  use_stylesheet("jquery-ui-1.8.12.custom.css");
  include_partial("insideMenu",array("param" => $param)) 
?>

<h3>Gestion des creneaux off</h3>

<div id="form_creneau">
  
  <p>Astuce : restez appuyer sur la touche "ctrl" afin de sélectionner plusieurs salles :)</p>
  
  <div class="left">
    <h4>Ajout d'une journée Off</h4>
    <?php if (isset($errD)): ?>
      <?php if (count($errD) > 0): ?>
        <ul>
        <?php foreach ($errD as $e): ?>
          <li><?php echo $e ?></li>
        <?php endforeach ?>
        </ul>
      <?php else: ?>
        <p>Journée Off ajouter avec succès !</p>
      <?php endif ?>
    <?php endif ?>
    <form method="post" action="<?php url_for ('reservation_creneauoff') ?>">
      <?php echo $formDay ?>
      <br />
      <input type="submit" name="day" value="Valider" />    
    </form>
  </div>

  <div class="right">
    <h4>Ajout d'un horaire Off</h4>
    <?php if (isset($errH)): ?>
      <?php if (count($errH) > 0): ?>
        <ul>
        <?php foreach ($errH as $e): ?>
          <li><?php echo $e ?></li>
        <?php endforeach ?>
        </ul>
      <?php else: ?>
        <p>Horaire Off ajouter avec succès !</p>
      <?php endif ?>
    <?php endif ?>
    <form method="post" action="<?php url_for ('reservation_creneauoff') ?>">
      <?php echo $formHour ?>
      <br />
      <input type="submit" name="hour" value="Valider" />
    </form>
  </div>
  
<div>

<script>
$('.date').datepicker({dateFormat : "dd-mm-yy"});
</script>

