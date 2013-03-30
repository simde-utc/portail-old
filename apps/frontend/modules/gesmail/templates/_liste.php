<ul class="nav nav-tabs">
  <li class="dropdown<?php if(isset($box) && $box->type == "alias") echo " active"; ?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-envelope"></i> Redirections
        <b class="caret"></b>
      </a>
    <ul class="dropdown-menu">
      <li<?php if(isset($box) && $box->getName() == $asso->getLogin()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail', array('login' => $asso->getLogin())) ?>"> <?php echo $asso->getLogin() ?></a></li>
      <?php if(count($boxes['alias']) > 0): ?>
        <?php foreach($boxes['alias'] as $abox): ?>
        <li<?php if(isset($box) && $box->getName() == $abox->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $abox->extension, 'login' => $asso->getLogin())) ?>"> <?php echo $abox->getName() ?></a></li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
  </li>
  <li class="dropdown<?php if(isset($box) && $box->type == "ml") echo " active"; ?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-list"></i> Mailing-listes
        <b class="caret"></b>
      </a>
    <?php if(count($boxes['ml']) > 0): ?>
    <ul class="dropdown-menu">
        <?php foreach($boxes['ml'] as $abox): ?>
        <li<?php if(isset($box) && $box->getName() == $abox->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $abox->extension, 'login' => $asso->getLogin())) ?>"><?php echo $abox->getName() ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </li>
  <li><a href="<?php echo url_for('gesmail_create', array('login' => $asso->getLogin())) ?>"><i class="icon-plus"></i> Ajouter</a></li>
</ul>