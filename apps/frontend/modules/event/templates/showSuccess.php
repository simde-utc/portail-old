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
  <div>
  <?php if($event->getAffiche()): ?>
    <?php echo showThumb($event->getAffiche(), 'events', array(
      'width'=>350,
      'height'=>250,
      'class'=>'pull-right img-polaroid'
    ), 'scale') ?><br />
  <?php endif; ?>
  </div>
  <p>Du <?php echo format_date($event->getStartDate(), 'f', 'fr') ?> au
    <?php echo format_date($event->getEndDate(), 'f', 'fr') ?></p>
  <p>
    <?php echo event_from_asso_list($event) ;?>
    <br/>
    Type : <?php echo $event->getType()->getName(); ?><br />
    Lieu : <?php echo $event->getPlace(); ?>
  </p>

  <p><?php echo nl2br($event->getSummary()) ?></p>
  <p>
    <strong>Participants : </strong> 
    <?php if($participants->count() == 0): ?>
      Pas de participants encore inscrits.
    <?php else : ?>
    <?php $i = 0; while($i < $participants->count() ) { ?>
      <?php if( $i < $participants->count() - 1) : ?>
        <?php echo $participants[$i++]->getUser()->getName().', ' ; ?>
      <?php elseif($i == 4): ?>
        <?php echo $participants[$i++]->getUser()->getName().', ...' ; ?>
      <?php else: ?>
        <?php echo $participants[$i++]->getUser()->getName() ; ?>
     <?php endif; ?> 
    <?php } ?>
      
    <?php endif; ?>
  </p> 
  <?php if($sf_user->isAuthenticated()): ?> 
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
    <p>Connectez-vous pour participer à l'évènement. </p>
  <?php endif; ?>
  <p><?php echo nl2br($event->getDescription(ESC_XSSSAFE)) ?></p>
  <p>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php
    echo urlencode(url_for('event_show', $event, true))
    ?>&t=<?php echo urlencode($event->getName()) ?>" target="_blank" class="facebook">
      Partager sur Facebook
    </a>
  </p>
</div>
<?php if($galeries->count() > 0): ?>
  <div class="part" id="galerie">
    <h1>Galerie Photo
      <?php if($sf_user->isAuthenticated()
       && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)): ?>
        <span class="pull-right">
          <i class="icon-plus icon-white"></i>
          <a href="<?php echo url_for('galerie_photo_new', $event) ?>">Ajouter une galerie photo</a>
        </span>
      <?php endif ?>
    </h1>
    <?php foreach ($galeries as $galery)
      include_component('galerie', 'preview',  array('galery' =>  $galery, 'sf_user' =>$sf_user));
    ?>
  </div>
<!-- Pas de galeries -->
<?php elseif ($sf_user->isAuthenticated()
    && $sf_user->getGuardUser()->hasAccess($event->getAsso()->getLogin(), 0x200)): ?>
  <div class="part" id="galerie">
    <h1>Galerie Photo
      <span class="pull-right">
        <i class="icon-plus icon-white"></i>
        <a href="<?php echo url_for('galerie_photo_new', $event) ?>">Ajouter une galerie photo</a>
      </span>
  	</h1>
  </div>
  <p href="<?php echo url_for('galerie_photo_new', $event) ?>"> Vous n'avez pas encore ajouté d'albums photos à votre évènement. Vous pouvez le faire en cliquant sur ce texte.</p>
<?php endif; ?>


