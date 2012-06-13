<?php use_helper('Thumb') ?>
<?php use_helper('Date') ?>
<h1>Derniers articles</h1>
<div id="articles">
  <?php if($articles->count() > 0): ?>
    <div id="article_list">
      <?php foreach($articles as $article) : ?>
        <div class="article">
          <h2 style="background: <?php echo $article->getPole()->getCouleur() ?>"><?php echo $article->getName() ?>
            <span class="sub">
              <a href="<?php echo url_for('assos_show',$article->getAsso()->getLogin())?>" title="Voir la page de <?php echo $article->getAsso()->getName() ?>"><?php echo $article->getAsso()->getName() ?></a>,
              le <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?>
              <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)): ?>
                <i class="icon-edit icon-white"></i> <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Éditer</a>
              <?php endif ?>
            </span>
          </h2>
          <?php if($article->getImage()): ?>
            <?php echo showThumb($article->getImage(), 'articles', array('width'=>250, 'height'=>150, 'class' => 'affiche'), 'scale') ?><br />
          <?php endif; ?>
          <p>
            <?php if($article->getSummary()): ?>
              <?php echo nl2br($article->getSummary()) ?> <a href="<?php echo url_for('article/show?id='.$article->getId()) ?>">En savoir plus...</a>
            <?php else: ?>
              <?php echo nl2br($article->getText()) ?>
            <?php endif; ?>
          </p>
          <br style="clear: right;" />
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    Aucun article à afficher pour le moment.
  <?php endif ?>
</div>
