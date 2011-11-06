<div id="random_asso">
  <img src="<?php echo $asso->getLogo() ?>" width="64" height="64" alt="<?php echo $asso->getName() ?>" />
  <h2>
    <?php echo $asso->getName() ?>
  </h2>
  <p>
    <?php echo $asso->getDescription() ?>
  </p>
  <div class="barre"></div>
  <a href="<?php echo url_for('assos_show',$asso) ?>" class="more">>> En savoir plus</a>
</div>