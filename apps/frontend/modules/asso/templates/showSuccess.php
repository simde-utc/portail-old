<?php use_stylesheet('asso.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $asso ? $asso->getName() : "Cette association n'existe pas"?></h2>
<?php if ($asso) { ?>
<ul id="assos_list">
	<li>
		<h3><a href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getName() ?></a></h3>
		<img class="logo" src="<?php echo $asso->getLogo() ?>">
		<div class="desc">
			<?php echo truncate_text($asso->getDescription(), 256) ?>
			</br>
			<a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
		</div>
	</li>
</ul>
<?php } ?>
