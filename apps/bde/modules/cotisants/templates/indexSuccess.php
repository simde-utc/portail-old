<?php include_component('cotisants', 'searchForm') ?>
<hr>

<h2>Statistiques</h2>
<p>L'historique ci-dessous correspond au nombre de cotisations perçues à chaque semestre.</p>

<?php if(!empty($error)): ?>
  <div class="alert alert-error"><?php echo $error ?></div>
<?php endif ?>

<?php if(!empty($statistiques)): ?>
<?php foreach($statistiques as $semestre => $nbcotisants): ?>
  <?php echo $semestre ?> : <?php echo $nbcotisants ?><br />
<?php endforeach ?>
<?php endif ?>