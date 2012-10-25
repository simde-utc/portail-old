<?php use_stylesheet('asso.css') ?>
<?php use_helper('Text') ?>
<?php use_helper('Thumb') ?>

<div id="poles_list">
  <ul>
    <?php foreach($poles as $p) : ?>
      <li>
        <a href="<?php echo url_for('assos_list_pole',array('pole' => $p->getPrimaryKey())) ?>">
          <img class="logo" src="<?php echo $p->getInfos()->getLogo() ?>">
          <?php echo $p->getInfos()->getName() ?></a><br /><br />
        <a href="<?php echo url_for('assos_show',$p->getInfos()) ?>">Voir la fiche</a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<h2><?php echo isset($pole) ? $pole->getInfos()->getName() : "Liste des associations" ?></h2>

<?php include_partial('asso/list',array('assos' => $assos)) ?>