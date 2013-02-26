<h1>Élections du nouveau BDE</h1>
<h2>1. Je consulte les programmes</h2>
<?php foreach($listes as $liste): ?>
  <div class="well liste">
    <h3><?php echo $liste->getNom() ?></h3>
    <h4>Programme:</h4>
    <p>
      <?php echo html_entity_decode($liste->getDescription()) ?>
    </p>
    <h4>Membres:</h4>
    <p>
      <?php echo html_entity_decode($liste->getMembres()) ?>
    </p>
  </div>
<?php endforeach ?>
<h2>2. Je vote</h2>
<?php if($is_cotisant): ?>
  <?php if(!$has_voted): ?>
    <?php foreach($listes as $liste): ?>
      <a href="<?php echo url_for('vote',$liste) ?>" class="btn btn-primary liste">Je vote <?php echo $liste->getNom() ?></a>
    <?php endforeach ?>
  <?php else: ?>
    Vous avez déjà voté.
  <?php endif ?>
<?php else: ?>
  Vous n'êtes pas cotisant, vous ne pouvez pas participer à l'élection du nouveau BDE.
<?php endif ?>
