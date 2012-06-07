<?php use_helper('Date') ?>
<?php use_helper('Thumb');?>
<?php use_stylesheet('jquery.lightbox-0.5.css') ?>
<?php use_javascript('jquery.lightbox-0.5.js') ?>

    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>

</head>

<h3><?php echo $album->getName() ?></h3>
     <h7><i>Créé le : <?php echo format_date($album->getCreatedAt()) ?> </i></h7>
     <br /><br />
     <div id="gallery">
<ul class="thumbnails">
  <?php foreach($album->getImages() as $image): ?>
      <?php if($image->getName() != ""): ?>
  <li class="span2">
    <div class="thumbnail">
       <?php// if(image exists): ?>
                  <?php doThumb($image->getName(), 'albums', array('width'=>800, 'height'=>600), 'scale') ?>
        <?php// endif ?>
      <?php  echo "<a href='http://simde/uploads/albums/thumb/800x600_" . $image->getName() . "' title='" .  $image->getLegend() . "'>"; ?>
      <?php echo showThumb($image->getName(), 'albums', array('width'=>130, 'height'=>120), 'scale') ?>
      <?php  echo "</a>" ;?>
      <h5><?php echo $image->getLegend() ?></h5>
    </div>
  </li>
          <?php endif ?>
      <?php endforeach;?>
</ul>
     </div>
<hr />

<a class="btn btn-inverse" href="<?php echo url_for('album/index') ?>"><i class="icon-list-alt icon-white"></i> Retour</a>
&nbsp;
<a class="btn btn-warning" href="<?php echo url_for('album/edit?id='.$album->getId()) ?>"><i class="icon-edit icon-white"></i> Modifier</a>
&nbsp;
<?php echo link_to('<i class="icon-trash icon-white"></i> Supprimer', 'album/delete?id='. $album->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sur de vouloir supprimer défintivement cet album photo ?', 'class' => 'btn btn-danger')) ?>
          