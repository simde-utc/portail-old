<?php use_helper('Thumb') ?>
<?php use_helper('Date') ?>
<h5 class="partie">Derniers articles</h5>
<div id="articles">
  <?php if($articles->count() > 0): ?>
    <div id="article_list">
      <?php foreach($articles as $article) : ?>
        <div class="article">
          <h2 style="background: <?php echo $article->getPole()->getCouleur() ?>">
            <a href="<?php echo url_for('assos_show', $article->getAsso()) ?>" title="<?php echo $article->getAsso()->getName() ?>">
                <?php echo showThumb($article->getAsso()->getLogo(), 'assos', array('width'=>32, 'height'=>32, 'alt'=> $article->getAsso()->getName(), 'title' => $article->getAsso()->getName()), 'center') ?>
            </a>
            
            <a href="<?php echo url_for('article/show?id='.$article->getId()) ?>" title="Lire <?php echo $article->getName() ?>"><?php echo $article->getName() ?></a>
            <span class="sub">
              <a href="<?php echo url_for('assos_show', $article->getAsso()) ?>" title="<?php echo $article->getAsso()->getName() ?>"><?php echo $article->getAsso()->getName() ?></a>,
              <?php echo format_date($article->getCreatedAt(), 'P', 'fr'); ?>
              <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)): ?>
                – <i class="icon-edit icon-white"></i> <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Éditer</a>
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
    Aucun article à afficher pour le moment.
  <?php endif ?>
</div>
