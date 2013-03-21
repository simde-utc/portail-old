<h1>Budget categories List For <?php echo $asso->getName() ?></h1>

<table>
  <thead>
    <tr>
      <th>Categorie</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budget_categories as $budget_categorie): ?>
    <tr>
      <td><?php echo $budget_categorie->getNom() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('budget_categorie_new', $asso) ?>" class="btn btn-primary">New</a>
