<?php use_helper('Date'); ?>
<h1>Articles</h1>
<?php foreach($articles as $article): ?>
<div class="article">
  <h2 style="background: <?php echo $article->getPole()->getCouleur()?>"><?php echo $article->getName() ?><span class="sub"><a href="<?php echo url_for('assos_show',$article->getAsso())?>" title="Voir la page de <?php echo $article->getAsso()->getName() ?>"><?php echo $article->getAsso()->getName() ?></a>, le <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?></span></h2>
  <div class="article_content">
    <?php echo $article->getText() ?>
  </div>
</div>
<?php endforeach ?>
<hr />
<a class="more"> >>> Voir tous les articles</a>