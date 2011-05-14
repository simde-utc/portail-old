<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo isset($asso) ? "Article de : ".$asso->getName() : "Liste des articles" ?></h2>
<!-- todo only if authorized -->
<a href="<?php echo url_for('article/new') ?>">Ecrire un article</a>

<ul id="article_list">
  <?php foreach($articles as $article) : ?>

    <li>
      <h3><?php echo $article->getName() ?></h3>
  		Publié par <?php echo $article->getAsso()->getName() ?> le <?php echo $article->getCreatedAt() ?>  
      <!-- todo only if authorized -->
  		- <a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Editer</a>

      <img class="logo" src="<?php echo $article->getAsso()->getLogo() ?>">
      <div class="desc">
        <?php echo truncate_text($article->getText(),256) ?>
        </br>
        <a class="link" href="<?php echo url_for('article/show/?id='.$article->getId()) ?>">Lire la suite</a>
      </div>
    </li>

  <?php endforeach; ?>
</ul>
