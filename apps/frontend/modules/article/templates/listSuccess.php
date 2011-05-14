<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $asso ? "Article de : " . $asso->getInfos()->getName() : "Liste des articles"?></h2>
<ul id="article_list">
<?php foreach($articles as $article) : ?>

	<li>
		<h3><?php echo $article->getName() ?></h3>
		Publié par <?php echo $article->getAsso()->getName() ?> le <?php echo $article->getCreatedAt() ?>
		<img class="logo" src="<?php echo $article->getAsso()->getLogo() ?>">
		<div class="desc">
			<?php echo truncate_text($article->getText(), 256) ?>
			</br>
			<a class="link" href="<?php echo url_for('article/show/', array('id' => $article)) ?>">Lire la suite <?php $article->getId(); ?></a>
		</div>
	</li>
	
<?php endforeach;?>
</ul>
