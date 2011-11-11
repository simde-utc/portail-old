<h1>Articles</h1>
<?php foreach($articles as $article): ?>
<div class="article">
  <h2 style="background: <?php echo $article->getPole()->getCouleur()?>"><?php echo $article->getName() ?> - Par <?php echo $article->getAsso()->getName() ?> - Date <?php echo $article->getCreatedAt() ?></h2>
  <div class="article_content">
    <?php echo $article->getText() ?>
  </div>
</div>
<?php endforeach ?>
<hr />
<a class="more"> >>> Voir tous les articles</a>