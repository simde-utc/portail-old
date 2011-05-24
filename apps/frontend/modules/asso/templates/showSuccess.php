<?php use_stylesheet('asso.css') ?>
<?php use_stylesheet('article.css') ?>
<?php use_helper('Text') ?>

<h2><?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h2>
<?php if($asso): ?>
	<?php include_partial('asso/sidebar', array('asso' => $asso)) ?>
  <div id="asso">
  
	  	<ul>
				<li><a href="#articles">Articles</a></li>
				<li><a href="#events">Évènements</a></li>
				<?php if($asso->isPole()) : ?><li><a href="#assos">Assos</a></li><?php endif;?>
			</ul>
	
	<div id="articles">
	<h3>Articles de <?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h3>
	<?php if(count($articles) > 0): ?>
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
	
	<div id="assos">
	
	<h3>Associations de <?php echo $asso ? $asso->getName() : "Cette association n'existe pas" ?></h3>
		<div class="assos_pole">
		<?php include_partial('asso/list', array('assos' => $assos)) ?>
		</div>
	</div>
  </div>
<?php endif ?>

<script>
	$("#asso").tabs();
</script>
