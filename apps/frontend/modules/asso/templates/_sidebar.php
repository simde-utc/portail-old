<div id="sidebar">
  <?php if($asso) : ?>
		<h3><a href="<?php echo url_for('asso/show?login='.$asso->getLogin()) ?>"><?php echo $asso->getName() ?></a></h3>
		<div id="logo_asso"><img src="<?php echo $asso->getLogo() ?>"></div>
      
      <div class="desc">
        <?php echo html_entity_decode($asso->getDescription()) ?>
        </br>
        <a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
      </div>

  <?php endif; ?>
</div>
