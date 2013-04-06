<?php use_helper('Number');

function format_montant($montant) {
  $tot = '<td>' . format_currency(abs($montant), '€', 'fr_FR') . '</td>';
  return ($montant >= 0) ? "<td></td>".$tot : $tot."<td></td>";
}
?>



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

<h1>Budget <?php echo $budget->getNom() ?> pour <?php echo $budget->getAsso()->getName() ?></h1>

<?php if(count($categories) > 0): ?>
  <table class="table table-striped table-bordered table-hover table-treso-budget">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Dépense</th>
        <th>Recette</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categories as $categorie): ?>
      <tr class="table-treso-categorie">
        <td><?php echo $categorie->getNom() ?></td>
        <?php echo format_montant($categorie->getTotal()) ?>
        <td><a href="<?php echo url_for('budget_poste_new', array('budget' => $budget->getPrimaryKey(), 'categorie' => $categorie->getPrimaryKey())) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i></a></td>
      </tr>
      <?php foreach ($categorie->getPostesForBudget($budget) as $poste): ?>
      <tr class="table-treso-ligne">
        <td><?php echo $poste->getNom() ?></td>
        <?php echo format_montant($poste->getTotal()) ?>
        <td>
          <a href="<?php echo url_for('budget_poste_delete', $poste) ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>
          <a href="<?php echo url_for('budget_poste_edit', $poste) ?>" class="btn"><i class="icon-pencil icon-black"></a></td>
        </tr>
      <?php endforeach; ?>
    <?php endforeach; ?>
    <tr class="table-treso-categorie">
      <td>
       <select>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select> 
    </td>
    <td></td>
    <td></td>
    <td>Valider</td>
  </tr>
</tbody>
</table>
<?php endif ?>

<p>

  <a class="btn btn-danger" href="<?php echo url_for('budget_delete', $budget) ?>">
    <i class="icon-trash icon-white"></i>&nbsp;&nbsp;
    Supprimer le budget
  </a>
  <a class="btn btn" href="<?php echo url_for('budget_edit', $budget) ?>">
    <i class="icon-pencil icon-black"></i>&nbsp;&nbsp;
    Modifier le nom du budget
  </a>
</p>

<script>
$( document ).ready(function() {
    $( "a" ).click(function( event ) {
        alert( "As you can see, the link no longer took you to jquery.com" );
        event.preventDefault();
    });
});
</script>