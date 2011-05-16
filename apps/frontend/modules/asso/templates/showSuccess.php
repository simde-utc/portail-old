<?php use_stylesheet('asso.css') ?>
<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h2>
<?php if($asso): ?>
  <div id="asso">
  
	  	<ul>
				<li><a href="#description"><?php echo $asso->getName() ?></a></li>
				<li><a href="#articles">Articles</a></li>
				<li><a href="#events">Évènements</a></li>
			</ul>
			
			<img class="logo" src="<?php echo $asso->getLogo() ?>">
			
		<div id="description">
      
      <div class="desc">
  			<?php echo html_entity_decode(truncate_text($asso->getDescription(),256)) ?>
        </br>
        <a class="website" href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
      </div>
	</div>
	
	<div id="articles">
	<h3>Articles de <?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h3>
	<?php if(count($articles) > 0): ?>
	<ul id="article_list">
	<?php foreach($articles as $article) : ?>
	  <h4><?php echo $article->getName() ?></h4>
	  Publié par <?php echo $article->getAsso()->getName() ?> le <?php echo $article->getCreatedAt() ?>  
	  <!-- todo only if authorized -->
	  - <a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>">Editer</a>
	
	  <div class="desc">
	  <?php echo html_entity_decode(truncate_text($article->getText(),256)) ?>
	  </br>
	  <a class="link" href="<?php echo url_for('article/show/?id='.$article->getId()) ?>">Lire la suite</a>
	  </div>
	
	<?php endforeach; ?>
	</ul>
	<?php else: ?>
	  Cette association n'a pas encore publié d'article.
	<?php endif ?>
	</div>
	<div id="events">
	
	<h3>Événement de <?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h3>
	<?php if(count($events) > 0): ?>
	
	<ul id="event_list">
	<?php foreach($events as $event) : ?>
	  <h4><?php echo $event->getName() ?></h4>
	  Publié par <?php echo $event->getAsso()->getName() ?> le <?php echo $event->getCreatedAt() ?>  
	  <!-- todo only if authorized -->
	  - <a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>">Editer</a>
	
	  <img class="logo" src="<?php echo $event->getAsso()->getLogo() ?>">
	  <div class="desc">
	  <?php echo html_entity_decode(truncate_text($event->getDescription(),256)) ?>
	  </br>
	  <a class="link" href="<?php echo url_for('event/show/?id='.$event->getId()) ?>">Lire la suite</a>
	  </div>
	
	<?php endforeach; ?>
	</ul>
	<?php else: ?>
	  Cette association n'a pas encore proposé d'événement.
	<?php endif ?>
	</div>

  </div>
<?php endif ?>

<script>
	$("#asso").tabs();
</script>
