<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>

<div class="part" id="article">
  <h1>
    <?php echo $article->getName() ?>
    <?php if ($sf_user->isAuthenticated()
      && $sf_user->getGuardUser()->hasAccess($article->getAsso()->getLogin(), 0x04)
    ): ?>
      <span class="pull-right">
          <i class="icon-edit icon-white"></i>
          <a href="<?php echo url_for('article/edit?id=' . $article->getId()) ?>">Éditer</a>
      </span>
    <?php endif ?>
  </h1>

  <?php if ($article->getImage()): ?>
    <?php echo showThumb($article->getImage(), 'articles', array(
      'width' => 350,
      'height' => 250,
      'class' => 'pull-right img-polaroid'
    ), 'scale') ?><br/>
  <?php endif; ?>

  <p>
    Publié par <a href="<?php echo url_for('assos_show', $article->getAsso()) ?>"
                  title="Voir la page de <?php echo $article->getAsso()->getName() ?>">
      <?php echo $article->getAsso()->getName() ?>
    </a>
  </p>

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
</div>
