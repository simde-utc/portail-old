<?php use_helper('Thumb');?>

<h2>Liste des albums photos</h2>


<?php if(1==1)://if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->hasAccess($asso->getLogin(), 0x04)): ?>
<a class="btn btn-success" href="<?php echo url_for('album_new', $asso)?>"><i class="icon-plus icon-white"></i> Ajouter un album</a>
    <?php endif ?>
<br /><br />
<?php $compteur = 0; ?>
 <?php if($albums->count() > 0): ?>
<?php foreach($albums as $album): ?>
    <?php $compteur++; ?>
    <div class="well">
    <div class="event-item">
    <h3><span class="badge badge-info"><?php echo $compteur; ?></span>  <a href="<?php echo url_for('album/show?id='.$album->getId())?>"><?php echo $album->getName(); ?></a></h3>

    <ul class="thumbnails">
            <?php foreach($album->getImages() as $image): ?>
                <?php if($image->getName() != ""): ?>
    <li class="span2">
        <div class="thumbnail">
       <?php echo showThumb($image->getName(), 'albums', array('width'=>130, 'height'=>120), 'scale') ?>
      <h5><?php echo $image->getLegend() ?></h5>
    </div>
    </li>
    <?php endif;?>
        <?php endforeach;?>
    </ul>
  
  
</div></div>
<?php endforeach; ?>
    <?php else: ?>
      Cette association n'a pas encore publié d'albums photos.
    <?php endif ?>

