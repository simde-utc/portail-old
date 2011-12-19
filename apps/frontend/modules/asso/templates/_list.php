<?php use_stylesheet('home.css') ?>
<?php use_helper('Text') ?>

<ul id="assos_list">
  <?php foreach($assos as $asso) : ?>
	<?php if(!$asso->isPole()) : ?>
    <li>
      <h3><a href="<?php echo url_for('asso/show?login='.$asso->getLogin()) ?>"><?php echo $asso->getName() ?></a></h3>
      <img class="logo" src="<?php echo $asso->getLogo() ?>">
      <div class="desc">
        <?php echo truncate_text($asso->getDescription(),256) ?>
        </br>
        <a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a> - <a class="email" href="mailto:<?php echo $asso->getLogin() ?>@assos.utc.fr"><?php echo $asso->getLogin() ?>@assos.utc.fr</a>
      </div>
    </li>
	<?php endif;?>
  <?php endforeach; ?>
</ul>
