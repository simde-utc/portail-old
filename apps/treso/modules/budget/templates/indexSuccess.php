<?php use_helper('Date') ?>
<h1>Budgets en cours</h1>

<?php if (count($budgets) == 0): ?>
  <p><br/>
    <b>Aucun budget actif !</b><br/>
    Créez un nouveau budget prévisionnel pour commencer.
    <br/>
  </p>
<?php else: ?>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Semestre</th>
        <th>Date de création</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($budgets as $budget): ?>
      <tr>
        <td><a href="<?php echo url_for('budget_show', array('id' => $budget->getPrimaryKey())) ?>"><?php echo $budget->getNom() ?></a></td>
        <td><?php echo $budget->getSemestre() ?></td>
        <td><?php echo format_date($budget->getCreatedAt(), 'D', 'fr') ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<a class="btn btn-success" href="<?php echo url_for('budget_new', $asso) ?>"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Créer un budget prévisionnel</a>
