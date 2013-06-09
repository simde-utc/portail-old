<?php use_helper('Number');

use_javascript('treso_unused_categories.js');

function format_montant($montant) {
  $tot = '<td>' . format_currency(abs($montant), '€', 'fr_FR') . '</td>';
  return ($montant >= 0) ? "<td></td>".$tot : $tot."<td></td>";
}

function format_progressbar($sum, $total) {
  $percentage = $sum/$total * 100;
  if ($percentage >= 0 && $percentage < 90) {
    return '<div class="progress">
    <div class="bar bar-success" style="width: '.$percentage.'%;"><span class="percentage">'.number_format(abs($sum), 1).'/'.number_format(abs($total),1).'</span></div>
    </div>';
  }
  else if ($percentage >= 90 && $percentage < 100) {
    return '<div class="progress"><div class="bar bar-warning" style="width: '.$percentage.'%;"><span class="percentage">'.number_format(abs($sum), 1).'/'.number_format(abs($total),1).'</span></div></div>';
          }
  else {
    return '<div class="progress progress-striped"><div class="bar bar-danger" style="width: 100%;"><span class="percentage">'.number_format(abs($sum), 1).'/'.number_format(abs($total),1).'</span></div></div>';
  }
}

?>

<?php if(sfConfig::get('app_portail_current_semestre') > $budget->getSemestreId()): ?>
<div class="alert alert-block alert-error">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Attention !</strong> Ce budget prévisionnel correspond au semestre <?php echo $budget->getSemestre() ?>.
</div>
<?php endif; ?>

<div class="btn-group" style="float:right">
  <a class="btn btn-success"  href="<?php echo url_for("budget_categorie_new_from_budget", $budget) ?>">
    <i class="icon-plus icon-white"></i>
    Ajouter une catégorie
  </a>
  <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li>

      <a href="<?php echo url_for('budget_categorie', $assos);?>">
        Gestion des catégories
      </a>
    </li>
  </ul>
</div>

<h1 id="title_budget">Budget <?php echo $budget->getNom() ?> pour <?php echo $budget->getAsso()->getName() ?></h1>

  <table class="table table-striped table-bordered table-hover table-treso-budget">
    <thead>
      <tr>
        <th>Nom</th>
        <th>En cours</th>
        <th>Dépense</th>
        <th>Recette</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $debit_array = array();
            $credit_array = array();
            $total_debit = 0;
            $total_credit = 0; ?>
      <?php foreach ($categories as $categorie): ?>

      <?php
        $debit_sum = 0;
        $credit_sum = 0;
        ?>

      <tr class="table-treso-categorie">
        <td><?php echo $categorie->getNom() ?></td>
        <td></td>
        <?php echo format_montant($categorie->getTotal()) ?>
        <td><a href="<?php echo url_for('budget_poste_new', array('budget' => $budget->getPrimaryKey(), 'categorie' => $categorie->getPrimaryKey())) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i></a></td>
      </tr>
      <?php foreach ($categorie->getPostesForBudget($budget) as $poste): ?>

      <?php $_sum = $poste->getSumPoste();
                  $_total = $poste->getTotal();
                  if ($_total > 0)
                    $credit_sum+=$_total;
                  else
                    $debit_sum+=$_total;
             ?>

      <tr class="table-treso-ligne">
        <td><?php echo $poste->getNom() ?></td>

        <td>
            <?php echo format_progressbar($_sum, $_total) ?>
        </td>
        <?php echo format_montant($_total) ?>
        <td>
          <div class="btn-group pull-right">
            <a href="<?php echo url_for('transaction_new_with_budget_poste', array('asso_id' => $assos->getPrimaryKey(), 'poste_id' => $poste->getPrimaryKey())) ?>" class="btn"><i class="icon-plus"></i>&nbsp;&nbsp;Transaction</a>
            <a href="<?php echo url_for('budget_poste_edit', $poste) ?>" class="btn"><i class="icon-pencil"></i>&nbsp;&nbsp;Editer</a>
            <a href="<?php echo url_for('budget_poste_delete', $poste) ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>
          </div>
        </td>
        </tr>
      <?php endforeach; ?>
      <?php 
        if($debit_sum != 0){
          $debit_array[$categorie->getNom()] = abs($debit_sum);
          $total_debit += abs($debit_sum);
        }
        if($credit_sum != 0)
          $credit_array[$categorie->getNom()] = abs($credit_sum);
          $total_credit += abs($credit_sum);
       ?>
    <?php endforeach; ?>
    <?php

      foreach ($debit_array as $key => $value) {
        $for_high_debit_array[] = array($key, floatval(number_format($value/$total_debit * 100, 2)));
      }

      foreach ($credit_array as $key => $value) {
        $for_high_credit_array[] = array($key, floatval(number_format($value/$total_credit * 100, 2)));
      }
     ?>

    <script type="text/javascript">
      var _data_debit = <?php echo json_encode($for_high_debit_array); ?>;
      var _data_credit = <?php echo json_encode($for_high_credit_array); ?>;
    </script>

    <tr class="table-treso-categorie">
      <td>Catégories vides
       <select id="unused-categories-list">
        <?php foreach ($unused_categories as $categorie): ?>
        <option value="<?php echo $categorie->getPrimaryKey() ?>"><?php echo $categorie->getNom() ?></option>
        <?php endforeach; ?>
      </select>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php if (count($unused_categories) != 0): ?>
            <a href="#" id="unused-categories-btn" data-url-base="<?php echo url_for('budget_poste_new', array('budget'=>$budget->getPrimaryKey(), 'categorie'=>'')) ?>" class="btn btn-success"><i class="icon-white icon-plus"></i></a>
        <?php endif; ?>
    </td>
  </tr>
</tbody>
</table>

<!-- Graphic -->
<div style="margin:50px">
       <div style="display:inline-block" id="graphe_depense" style="min-width: 400px; height: 200px; margin: 10 auto"></div>
       <div style="display:inline-block" id="graphe_recette" style="min-width: 400px; height: 200px; margin: 10 auto"></div>
</div>

<p>

  <a class="btn btn-primary" href="<?php echo url_for('budget_export', $budget) ?>">
    <i class="icon-share-alt icon-white"></i>&nbsp;&nbsp;
    Exporter en PDF
  </a>
  <a class="btn btn-danger" href="<?php echo url_for('budget_delete', $budget) ?>">
    <i class="icon-trash icon-white"></i>&nbsp;&nbsp;
    Supprimer le budget
  </a>
  <a class="btn btn" href="<?php echo url_for('budget_edit', $budget) ?>">
    <i class="icon-pencil icon-black"></i>&nbsp;&nbsp;
    Modifier le nom du budget
  </a>
</p>
