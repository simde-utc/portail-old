<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo isset($asso) ? "Article de : " . $asso->getName() : "Liste des articles" ?></h2>
<?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
  <a href="<?php echo url_for('article/new') ?>">Ecrire un article</a>
<?php endif ?>

<ul id="article_list">
  <?php foreach ($articles as $article) : ?>

    <li>
      <h3><?php echo $article->getName() ?></h3>
      Publié par <?php echo $article->getAsso()->getName() ?> le <?php echo $article->getCreatedAt() ?>  
      <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
        - <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Editer</a>
      <?php endif ?>
      <img class="logo" src="<?php echo $article->getAsso()->getLogo() ?>">
      <div class="desc">
        <?php echo truncate_text($article->getText(), 256) ?>
        </br>
        <a class="link" href="<?php echo url_for('article/show/?id=' . $article->getId()) ?>">Lire la suite</a>
      </div>
    </li>

  <?php endforeach; ?>
</ul>
