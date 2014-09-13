<?php if($assos && $assos->count() > 0): ?>
  <ul class="nav">
    <li class="dropdown">
      <a class="dropdown-toggle brand" data-toggle="dropdown" href="<?php echo url_for('homepage') ?>">
        <?php if($current_asso): ?>
          Tréso <?php echo $current_asso->getName(); ?>
        <?php else: ?>
          BDE-UTC - Outils de Trésorerie
        <?php endif; ?>
        <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <?php foreach($assos as $asso): ?>
          <?php if(empty($current_asso) || ($current_asso->getId() != $asso->getId())): ?>
          <li>
              <a href="<?php echo url_for('budget_list', $asso) ?>"><?php echo $asso->getName() ?></a>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
        <li class="divider"></li>
        <li><a href="<?php echo url_for('homepage') ?>">Accueil</a></li>
      </ul>
    <li>
  </ul>
<?php else: ?>
  <a class="brand" href="<?php echo url_for('homepage') ?>">BDE-UTC - Outils de Trésorerie</a>
<?php endif ?>