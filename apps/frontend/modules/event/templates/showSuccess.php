<?php use_helper('Date') ?>
<?php use_helper('Thumb') ?>
<?php use_helper('Events') ?>


<div class="part" id="event">
  <h1>
    <?php echo $event->getName() ?>
    <?php if($sf_user->isAuthenticated()
      && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x04)): ?>
      <span class="pull-right">
        <i class="icon-edit icon-white"></i>
        <a href="<?php echo url_for('event/edit?id=' . $event->getId()) ?>">Éditer</a>
      </span>
    <?php endif ?>
  </h1>
  <div class="row-fluid">
    <div class="span8">
      <?php if(format_date($event->getStartDate(), 'D', 'fr') == format_date($event->getEndDate(), 'D', 'fr')) :?>
        <p><i class="fa fa-calendar fa-2x fa-fw"></i>Le <?php echo format_date($event->getStartDate(), 'D', 'fr') ?></p>
      <?php else : ?>
        <p><i class="fa fa-calendar fa-2x fa-fw"></i>Du <?php echo format_date($event->getStartDate(), 'D', 'fr') ?> au <?php echo format_date($event->getEndDate(), 'D', 'fr') ?></p>
      <?php endif; ?>
      <p><i class="fa fa-clock-o fa-2x fa-fw"></i>De <?php echo format_date($event->getStartDate(), 't', 'fr') ?> à <?php echo format_date($event->getEndDate(), 't', 'fr') ?></p>
      <p><i class="fa fa-home fa-2x fa-fw"></i><?php echo getAssoNameForEvent($event) ;?></p>
      <p><i class="fa fa-tag fa-2x fa-fw"></i><?php echo $event->getType()->getName(); ?></p>
      <p><i class="fa fa-map-marker fa-2x fa-fw"></i><?php echo $event->getPlace(); ?></p>
      <p><i class="fa fa-info-circle fa-2x fa-fw"></i><em><?php echo nl2br($event->getSummary()) ?></em></p>
      <?php if($sf_user->isAuthenticated()): ?> 
        <p><i class="fa fa-users fa-2x fa-fw"></i> 
        <?php if($participants->count() == 0): ?>
          Pas de participants encore inscrits.</p>
        <?php else : ?>
          <?php $i = 0; while($i < $participants->count() && $i < 5 ) : ?>
            <?php if( $i < 4 && $i < ($participants->count() - 1)) : ?>
              <a href="<?php echo url_for('profile/show?username=' . $participants[$i]->getUser()->getUsername()) ?>"><?php echo $participants[$i++]->getUser()->getName() ; ?></a>,  
            <?php else : ?>
              <a href="<?php echo url_for('profile/show?username=' . $participants[$i]->getUser()->getUsername()) ?>"><?php echo $participants[$i++]->getUser()->getName() ; ?></a>
              <?php if($participants->count() > 5) : ?>
                <a href="#participants-modal" data-toggle="modal">... (<?php echo $participants->count(); ?> participants)</a>
              <?php endif; ?>
            <?php endif; ?> 
          <?php endwhile ?>
        </p>
        <?php endif; ?>
        <!-- Modal -->
        <div id="participants-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Les <?php echo $participants->count(); ?> participants à l'évènement</h3>
          </div>
          <div class="modal-body">
            <ul class="nav nav-list">
              <?php foreach ($participants as $participant): ?>
                <li><a href="<?php echo url_for('profile/show?username=' . $participant->getUser()->getUsername()) ?>"><?php echo $participant->getUser()->getName() ; ?></a></li>
              <?php endforeach ; ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
          </div>
        </div>
        <?php if(!$jeparticipe): ?> 
          <p>
            <form action="<?php echo url_for('event/register?id='.$event->getId()) ?>" method="post" >
              <input class="btn btn-primary" type="submit" value="Participer" />
            </form>
          </p>
        <?php else: ?>
          <p>
            <form action="<?php echo url_for('event/unregister?id='.$event->getId()) ?>" method="post" >
              <input class="btn btn-danger" type="submit" value="Je ne participe plus" />
            </form>
          </p>
        <?php endif; ?>
      <?php else: ?>
        <p><em>Connectez-vous pour participer à l'évènement et voir les autres participants.</em></p>
      <?php endif; ?>
      <p class="well"><?php echo $event->getDescription(); ?></p>
      <p>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php
        echo urlencode(url_for('event_show', $event, true))
        ?>&t=<?php echo urlencode($event->getName()) ?>" target="_blank" class="facebook">
          Partager sur Facebook
        </a>
      </p>
    </div>
    <div class="span4">
      <?php if($event->getAffiche()): ?>
        <?php echo showThumb($event->getAffiche(), 'events', array(
          'width'=>350,
          'height'=>250,
          'class'=>'pull-right img-polaroid'
        ), 'scale') ?><br />
      <?php endif; ?>
    </div>
  </div>
</div>
<?php if($galeries->count() > 0 || $isPhotographer): ?>
  <div class="part" id="galerie">
    <h1>Galerie Photo
      <?php if($isPhotographer): ?>
        <span class="pull-right">
          <i class="icon-plus icon-white"></i>
          <a href="<?php echo url_for('galerie_photo_new', $event) ?>">Ajouter une galerie photo</a>
        </span>
      <?php endif ?>
    </h1>
    <?php if($galeries->count() > 0): ?> 
      <?php foreach ($galeries as $galery) : ?>
        <?php include_component('galerie', 'preview',  array('galery' =>  $galery)); ?>
      <?php endforeach ?>
    <?php else: ?> 
      <a href="<?php echo url_for('galerie_photo_new', $event) ?>"> Vous n'avez pas encore ajouté d'albums photos à votre évènement. Vous pouvez le faire en cliquant sur ce texte.</a>
    <?php endif; ?>
  </div>
<?php endif; ?>
