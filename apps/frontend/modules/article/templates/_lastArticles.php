<h1>Articles</h1>
<?php foreach($articles as $article): ?>
<div class="article">
  <h2 style="background: <?php echo $article->getPole()->getCouleur()?>"><?php echo $article->getName() ?> - Par <a href="<?php echo url_for('assos_show',$article->getAsso())?>"><?php echo $article->getAsso()->getName() ?></a> <span style="float: right;"><?php echo $article->getCreatedAt() ?></span></h2>
  <div class="article_content">
    <?php echo $article->getText() ?>
  </div>
</div>
<?php endforeach ?>
<hr />
<a class="more"> >>> Voir tous les articles</a>