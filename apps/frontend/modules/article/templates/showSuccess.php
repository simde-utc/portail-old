<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php $article->getName() ?> </h2>

<h3><?php echo $article->getName() ?></h3>
		Publié par <?php echo $article->getAsso()->getName() ?> le <?php echo $article->getCreatedAt() ?>  
<!-- todo only if authorized -->
		- <a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Editer</a>
<br/>
<img class="logo" src="<?php echo $article->getAsso()->getLogo() ?>">
<div class="desc">
  <?php echo $article->getText(); ?>
  </br>
</div>
