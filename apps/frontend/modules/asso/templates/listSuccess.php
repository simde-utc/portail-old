<?php use_stylesheet('asso.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $pole ? $pole->getInfos()->getName() : "Liste des associations"?></h2>
<ul id="assos_list">
<?php foreach($assos as $asso) : ?>

	<li>
		<h3><a href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getName() ?></a></h3>
		<img class="logo" src="<?php echo $asso->getLogo() ?>">
		<div class="desc">
			<?php echo truncate_text($asso->getDescription(), 256) ?>
			</br>
			<a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
		</div>
	</li>
	
<?php endforeach;?>
</ul>
