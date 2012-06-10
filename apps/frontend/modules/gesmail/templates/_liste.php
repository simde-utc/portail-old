<div class="span4">
  <div class="well sidebar-nav">
    <ul class="nav nav-list">
      <li class="nav-header">Redirections</li>
      <li<?php if($adr == -1) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail', array('login' => $asso->getLogin())) ?>"><?php echo $asso ?></a></li>
      <?php foreach($boxes['alias'] as $box): ?>
      <li<?php if($adr == $box['ID']) echo ' class="active"'; ?>><a href="<?php echo url_for('gesmail_box', array('box' => $box['ID'], 'login' => $asso->getLogin())) ?>"><?php echo $asso.'-'.$box['Extension']; ?></a></li>
      <?php endforeach; ?>
      <li<?php if($adr == 'newalias') echo ' class="active"'; ?>><a href="/gesmail/new/alias">+ Ajouter</a></li>
      <li class="nav-header">Mailing-listes</li>
      <?php foreach($boxes['ml'] as $box): ?>
      <li<?php if($adr == $box['ID']) echo ' class="active"'; ?>><a href="/gesmail/<?php echo $box['ID']; ?>"><?php echo $asso.'-'.$box['Extension']; ?></a></li>
      <?php endforeach; ?>
      <li<?php if($adr == 'newml') echo ' class="active"'; ?>><a href="/gesmail/new/ml">+ Ajouter</a></li>
    </ul>
  </div><!--/.well -->
</div><!--/span-->