<div class="part" >

<?php if ($form->getObject()->isNew()): ?>
<h2>Créer un album photo</h2>
<?php else: ?>
<h2>Modifier un album photo</h2>
<?php endif ?>
<br /><br />
<form class="editform well form-horizontal" action="<?php echo url_for('@submit') ?>" method="post" enctype="multipart/form-data" >
  <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form['name']->renderLabel()?> <?php echo $form['name']->renderError()?> <?php echo $form['name'] ?>
    <br/>
      <?php echo $form->renderHiddenFields() ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form['location']->renderLabel()?> <?php echo $form['location']->renderError()?> <?php echo $form['location'] ?>
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
      <?php if($occurrence['name'] != ""): ?>
    <li>
      <?php echo $occurrence['name']->renderLabel() ?>  <?php echo $occurrence['name']->renderError() ?>
      <?php echo $occurrence['name'] ?>
       <br />
      <?php echo $occurrence['legend']->renderLabel() ?>  <?php echo $occurrence['legend']->renderError() ?>
      <?php echo $occurrence['legend'] ?>
    </li>
        <?php endif ?>
    <?php endforeach ?>
  </ul>
<a id="addoccurrence" class="btn btn-success" href="#"><i class="icon-plus icon-white"></i> Ajouter une image</a><br /><br />
  <input class="btn btn-primary" type="submit" value="Sauvegarder l'album" />
</form>

<a class="btn btn-inverse" href="<?php echo url_for('album/index') ?>"><i class="icon-list-alt icon-white"></i> Retour</a>
&nbsp;

</div>