<?php use_stylesheet('bootstrap.min.css') ?>

<h1>Budget Categories @ <?php echo $asso->getName() ?></h1>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Categorie</th>
      <th>Commentaire</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($budget_categories as $budget_categorie): ?>
    <tr>
      <td><?php echo $budget_categorie->getNom() ?></td>
      <td><?php echo $budget_categorie->getCommentaire() ?></td>
      <td><a href="<?php echo url_for('budget_categorie_edit', $budget_categorie) ?>" class="btn"><i class="icon-pencil"></i> Editer</a>
        &nbsp;<a href="<?php echo url_for('budget_categorie_delete', $budget_categorie) ?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', '6b532d12ed0a064e8d4644df3006e02b'); f.appendChild(m);f.submit(); };return false;" class="btn btn-danger"><i class="icon-trash icon-white"></i>&nbsp;Supprimer</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('budget_categorie_new', $asso) ?>" class="btn btn-success"><i class="icon-plus icon-white"></i> Ajouter</a>
