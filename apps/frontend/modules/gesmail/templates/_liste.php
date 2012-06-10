<div class="span4">
  <div class="well sidebar-nav">
    <ul class="nav nav-list">
      <li class="nav-header">Redirections</li>
      <li<?php if($adr == $asso->getLogin()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail', array('login' => $asso->getLogin())) ?>"><?php echo $asso->getLogin() ?></a></li>
      <?php foreach($boxes['alias'] as $box): ?>
      <li<?php if($adr == $box->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $box->extension, 'login' => $asso->getLogin())) ?>"><?php echo $box->getName() ?></a></li>
      <?php endforeach; ?>
      <li<?php if($adr == 'newalias') echo ' class="active"'; ?>><a href="/gesmail/new/alias">+ Ajouter</a></li>
      <li class="nav-header">Mailing-listes</li>
      <?php foreach($boxes['ml'] as $box): ?>
      <li<?php if($adr == $box->getName()) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $box->extension, 'login' => $asso->getLogin())) ?>"><?php echo $box->getName() ?></a></li>
      <?php endforeach; ?>
      <li<?php if($adr == 'newml') echo ' class="active"'; ?>><a href="/gesmail/new/ml">+ Ajouter</a></li>
    </ul>
  </div><!--/.well -->
</div><!--/span-->