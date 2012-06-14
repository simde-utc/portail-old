<ul class="nav nav-tabs">
  <li class="dropdown<?php if($box->type == "alias") echo " active"; ?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        Redirections
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <li<?php if($box->getName() == $asso->getLogin()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail', array('login' => $asso->getLogin())) ?>"><i class="icon-envelope"></i> <?php echo $asso->getLogin() ?></a></li>
      <?php foreach($boxes['alias'] as $abox): ?>
      <li<?php if($box->getName() == $abox->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $abox->extension, 'login' => $asso->getLogin())) ?>"><i class="icon-envelope"></i> <?php echo $abox->getName() ?></a></li>
      <?php endforeach; ?>
      <li><a href="/gesmail/new/alias"><i class="icon-plus"></i> Ajouter</a></li>
    </ul>
  </li>
  <li class="dropdown<?php if($box->type == "ml") echo " active"; ?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        Mailing-listes
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <?php foreach($boxes['ml'] as $abox): ?>
      <li<?php if($box->getName() == $abox->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $abox->extension, 'login' => $asso->getLogin())) ?>"><i class="icon-list"></i> <?php echo $abox->getName() ?></a></li>
      <?php endforeach; ?>
      <li><a href="/gesmail/new/ml"><i class="icon-plus"></i> Ajouter</a></li>
    </ul>
  </li>
</ul>