<div class="part" >
  <h1>Bureau de <?php echo $asso ?></h1>
  <?php include_partial('asso/trombinoscope',array('membres' => $bureau)) ?>
  <h1>Membres de <?php echo $asso ?></h1>
  <?php include_partial('asso/trombinoscope',array('membres' => $membres)) ?>
</div>