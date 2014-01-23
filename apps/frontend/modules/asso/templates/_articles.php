<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<h1>
  Derniers articles
  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
    <span class="pull-right"><i class="icon-plus icon-white"></i> <a href="<?php echo url_for('article_new', $asso) ?>">Ajouter un article</a></span>
  <?php endif ?>
</h1>
<div id="articles">
  <?php if($articles->count() > 0): ?>
    <div id="article_list">
      <?php foreach($articles as $article) : ?>
        <div class="article">
          <h2 style="background: <?php echo $article->getPole()->getCouleur() ?>">
            <a href="<?php echo url_for('article/show?id='.$article->getId()) ?>" title="Lire <?php echo $article->getName() ?>"><?php echo $article->getName() ?></a>
            <span class="sub">
              <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?>
              <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)): ?>
                <i class="icon-edit icon-white"></i> <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Éditer</a>
              <?php endif ?>
            </span>
          </h2>
          <?php if($article->getImage()): ?>
            <?php echo showThumb($article->getImage(), 'articles', array('width'=>250, 'height'=>150, 'class' => 'pull-right img-polaroid'), 'scale') ?><br />
          <?php endif; ?>
          <p>
            <?php echo nl2br($article->getText(ESC_XSSSAFE)) ?>
          </p>
          <p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php
              echo urlencode(url_for('article_show', $article, true))
              ?>&t=<?php echo urlencode($article->getName()) ?>" target="_blank" class="facebook">
              Partager sur Facebook
            </a>
          </p>
          <br style="clear: both;" />
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    Cette association n'a pas encore publié d'article.
  <?php endif ?>
</div>
