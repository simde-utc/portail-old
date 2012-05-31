<?php use_helper('Thumb');?>

<h2>Liste des albums photos</h2>
<div class="well">
<!--apps/frontend/modules/templates/indexSuccess.php -->
<a class="btn btn-success" href="<?php echo url_for('@new')?>"><i class="icon-plus icon-white"></i> Ajouter un album</a>
<br /><br />
<?php $compteur = 0; ?>
<?php foreach($albums as $album): ?>
<?php $compteur++; ?>
<div class="event-item">
  <h3><span class="badge badge-info"><?php echo $compteur; ?></span>  <a href="<?php echo url_for('album/show?id='.$album->getId())?>"><?php echo $album->getName(); ?></a></h3>


  
  <ul class="thumbnails">
          <?php foreach($album->getImages() as $image): ?>
  <li class="span2">
    <div class="thumbnail">
      <?php echo "<img src='http://simde/uploads/albums/" . $image->getName() . "' width=150 height=150>" ;?>
      <h5><?php echo $image->getLegend() ?></h5>
      <p><?php echo $image->getLegend() ?></p>
    </div>
  </li>
      <?php endforeach;?>
</ul>
  
  
</div>
<?php endforeach; ?>

</div>