<?php use_helper('Thumb') ?>
<?php use_helper('Date') ?>
<div class="part">
<h1>Weekmail du <?php echo $weekmail->getPublishedAt() ?></h1>
<div id="articles">
    <div id="article_list">
        <div class="article">
            <h2 style="background-color: #535353;">Mot du BDE</h2>
            <?php echo nl2br($weekmail->getMotDuBde(ESC_XSSSAFE)) ?>
        </div>
        <div class="article">
            <h2 style="background-color: #535353;">Edito</h2>
            <?php echo nl2br($weekmail->getEdito(ESC_XSSSAFE)) ?>
        </div>
      <?php foreach(WeekmailArticleTable::getInstance()->getEventsForWeekmail($weekmail->getId())->execute() as $article) : ?>
        <div class="article">
          <h2 style="background: <?php echo $article->getAsso()->getCouleur() ?>">
            <a href="<?php echo url_for('event_show', $article->getEvent()) ?>"><?php echo $article->getName() ?></a>
            <span class="sub">
              <a href="<?php echo url_for('assos_show',$article->getAsso())?>" title="Voir la page de <?php echo $article->getAsso()->getName() ?>"><?php echo $article->getAsso()->getName() ?></a>,
              le <?php echo format_date($article->getEvent()->getCreatedAt(), 'P', 'fr'); ?>
            </span>
          </h2>
          <?php if($article->getImage()): ?>
            <?php echo showThumb($article->getImage(), 'events', array('width'=>250, 'height'=>150, 'class' => 'pull-right img-polaroid'), 'scale') ?><br />
          <?php endif; ?>
          <p>
            <?php echo nl2br($article->getText(ESC_XSSSAFE)) ?>
          </p>
          <br style="clear: both;" />
        </div>
      <?php endforeach; ?>
      <?php foreach(WeekmailArticleTable::getInstance()->getArticlesForWeekmail($weekmail->getId())->execute() as $article) : ?>
        <div class="article">
          <h2 style="background: <?php echo $article->getAsso()->getCouleur() ?>">
            <a href="<?php echo url_for('article_show', $article->getArticle()) ?>"><?php echo $article->getName() ?></a>
            <span class="sub">
              <a href="<?php echo url_for('assos_show',$article->getAsso())?>" title="Voir la page de <?php echo $article->getAsso()->getName() ?>"><?php echo $article->getAsso()->getName() ?></a>,
              le <?php echo format_date($article->getArticle()->getCreatedAt(), 'P', 'fr'); ?>
            </span>
          </h2>
          <?php if($article->getImage()): ?>
            <?php echo showThumb($article->getImage(), 'articles', array('width'=>250, 'height'=>150, 'class' => 'pull-right img-polaroid'), 'scale') ?><br />
          <?php endif; ?>
          <p>
            <?php echo nl2br($article->getText(ESC_XSSSAFE)) ?>
          </p>
          <br style="clear: both;" />
        </div>
      <?php endforeach; ?>
        <div class="article">
            <h2 style="background-color: #535353;">Editar</h2>
            <?php echo nl2br($weekmail->getEditar(ESC_XSSSAFE)) ?>
        </div>
    </div>
</div>
</div>
