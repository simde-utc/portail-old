<div class="part" >

<?php if ($form->getObject()->isNew()): ?>
<h2>Créer un album photo</h2>
<?php else: ?>
<h2>Modifier un album photo</h2>
<?php endif ?>
<br /><br />
<form class="editform well form-inline" action="<?php echo url_for('@submit') ?>" method="post" enctype="multipart/form-data" >
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form['name']->renderLabel()?> <?php echo $form['name']->renderError()?> <?php echo $form['name'] ?>
  <ul id="maListe">
    <?php if ($form->getObject()->isNew()): ?>
    <script type="text/javascript">newfieldscount = 1;</script>
      <li>
        <?php echo $form['new'][0]['name']->renderLabel() ?>  <?php echo $form['new'][0]['name']->renderError() ?>
        <?php echo $form['new'][0]['name'] ?>
         <br />
        <?php echo $form['new'][0]['legend']->renderLabel() ?>  <?php echo $form['new'][0]['legend']->renderError() ?>
        <?php echo $form['new'][0]['legend'] ?>
      </li>
    <?php endif ?>
    <?php foreach ($form['Images'] as $occurrence):?>
    <li>
      <?php echo $occurrence['name']->renderLabel() ?>  <?php echo $occurrence['name']->renderError() ?>
      <?php echo $occurrence['name'] ?>
       - 
      <?php echo $occurrence['legend']->renderLabel() ?>  <?php echo $occurrence['legend']->renderError() ?>
      <?php echo $occurrence['legend'] ?>
    </li>
    <?php endforeach ?>
  </ul>
<a id="addoccurrence" class="btn btn-success" href="#"><i class="icon-plus icon-white"></i> Ajouter une image</a><br /><br />
  <input class="btn btn-primary" type="submit" value="Save" />
</form>

<a href="<?php echo url_for('albums_list')?>">Back to index</a>

</div>