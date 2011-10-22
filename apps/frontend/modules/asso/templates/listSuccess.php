<?php use_stylesheet('asso.css') ?>
<?php use_helper('Text') ?>

<div id="poles_list">
  <ul>
    <?php foreach($poles as $p) : ?>
      <a href="<?php echo url_for('assos_list_pole',array('pole' => $p->getPrimaryKey())) ?>">
        <li>
          <img class="logo" src="<?php echo $p->getInfos()->getLogo() ?>">
          <?php echo $p->getInfos()->getName() ?>
        </li>
      </a>
    <?php endforeach; ?>
  </ul>
</div>
<div class="clear"></div>

<h2><?php echo isset($pole) ? $pole->getInfos()->getName() : "Liste des associations" ?></h2>

<?php include_partial('asso/list',array('assos' => $assos)) ?>