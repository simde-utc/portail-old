<h1>Élections du nouveau BDE</h1>
<h2>1. Je consulte les programmes</h2>
<?php foreach($listes as $liste): ?>
  <div class="well liste">
    <h3><?php echo $liste->getNom() ?></h3>
    <h4>Programme:</h4>
    <p>
      <?php echo $liste->getDescription(ESC_RAW) ?>
    </p>
    <h4>Membres:</h4>
    <p>
      <?php echo $liste->getMembres(ESC_RAW) ?>
    </p>
  </div>
<?php endforeach ?>
<h2>2. Je vote</h2>
<?php if($is_cotisant): ?>
  <?php if(!$has_voted): ?>
    <?php foreach($listes as $liste): ?>
      <a href="<?php echo url_for('vote',$liste) ?>" onclick="return confirm('Êtes-vous sûr de vouloir voter pour <?php echo addslashes($liste->getNom(ESC_RAW)) ?> ?');" class="btn btn-primary liste">Je vote <?php echo $liste->getNom() ?></a>
    <?php endforeach ?>
  <?php else: ?>
    Vous avez déjà voté.
  <?php endif ?>
<?php else: ?>
  Vous n'êtes pas cotisant, vous ne pouvez pas participer à l'élection du nouveau BDE.
<?php endif ?>
