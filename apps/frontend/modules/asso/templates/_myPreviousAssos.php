<?php if($prev_assos && $prev_assos->count() > 0): ?>
<?php use_helper('Thumb') ?>
<h5 class="bulle">Précédentes assos</h1>
<?php include_partial('asso/myAssosSidebar', array('assos' => $prev_assos)) ?>
<?php endif ?>
