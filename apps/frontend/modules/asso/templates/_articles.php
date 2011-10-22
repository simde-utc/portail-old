<div id="articles">
  <h3>Articles de <?php echo $asso->getName() ?></h3>
  <?php if($articles->count() > 0): ?>
    <div id="article_list">
      <?php foreach($articles as $article) : ?>
        <div class="article">
          <h4><?php echo $article->getName() ?></h4>
          <div class="actions">
            <!-- todo only if authorized -->
            <a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Editer</a>
          </div>
          <?php echo html_entity_decode($article->getText()) ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    Cette association n'a pas encore publié d'article.
  <?php endif ?>
</div>