 <?php use_helper('Date') ?>
<?php use_helper('Thumb');?>

<h3><?php echo $album->getName() ?></h3>
     <h7><i>Créé le : <?php echo format_date($album->getCreatedAt()) ?> </i></h7>
     <br /><br />
  
<ul class="thumbnails">
  <?php foreach($album->getImages() as $image): ?>
  <li class="span2">
    <div class="thumbnail">
        

               
                
      <?php  echo "<img src='http://simde/uploads/albums/" . $image->getName() . "' width=150 height=150>" ;?>
      <h5><?php echo $image->getLegend() ?></h5>
      <p><?php echo $image->getLegend() ?></p>
    </div>
  </li>
      <?php endforeach;?>
</ul>
<hr />

<a class="btn btn-inverse" href="<?php echo url_for('album/index') ?>"><i class="icon-list-alt icon-white"></i> Retour</a>
&nbsp;
<a class="btn btn-warning" href="<?php echo url_for('album/edit?id='.$album->getId()) ?>"><i class="icon-edit icon-white"></i> Modifier</a>
&nbsp;
<a class="btn btn-danger" href="<?php echo url_for('album/delete?id='.$album->getId()) ?>"><i class="icon-trash icon-white"></i> Supprimer</a>
&nbsp;
<?php echo link_to('Supprimer', 'album/delete?id='. $album->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sur de vouloir supprimer défintivement cet album photo ?', 'class' => 'btn btn-danger')) ?>
          