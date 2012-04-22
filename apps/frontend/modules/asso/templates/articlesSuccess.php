<?php use_helper('Date') ?>
<div class="part" >
  <h1>Nos Articles</h1>
  <div id="articles">
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
      <a href="<?php echo url_for('article_new', $asso) ?>">Ajouter un article</a><br /><br />
    <?php endif ?>
    <?php if($articles->count() > 0): ?>
      <div id="article_list">
        <?php foreach($articles as $article) : ?>
          <div class="article">
            <h2 style="background: <?php echo $article->getPole()->getCouleur() ?>"><?php echo $article->getName() ?>
              <span class="sub"><?php echo $article->getAsso()->getName() ?>, le <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?></span></h2>
            <p>
              <?php echo $article->getText() ?>
            </p>
            <a class="alink" href="#">En savoir plus</a>
            <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)): ?>
              <div class="actions">
                <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Editer</a>
              </div>
            <?php endif ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      Cette association n'a pas encore publié d'article.
    <?php endif ?>
  </div>
</div>