<div class="part">
  <h1>Liste de matériel</h1>
  <div class="well">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Asso</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($materiels as $materiel): ?>
          <tr>
            <td><?php echo $materiel->getNom() ?></td>
            <td><?php echo $materiel->getAsso() ?></td>
            <td><?php echo $materiel->getDescription() ?></td>
            <td><?php echo $materiel->getStockDisponible() ?></td>
            <td>
              <a href="" class="btn" rel="tooltip" data-original-title="Emprunter"><i class="icon-share-alt"></i></a>&nbsp
              <a href="<?php echo url_for('materiel_ajout',$materiel) ?>" class="btn" rel="tooltip" data-original-title="Ajouter"><i class="icon-plus"></i></a>&nbsp
              <a href="" class="btn" rel="tooltip" data-original-title="Perdu :'x"><i class="icon-trash"></i></a>&nbsp
              <a href="<?php echo url_for('materiel/edit?id=' . $materiel->getId()) ?>" class="btn" rel="tooltip" data-original-title="Editer"><i class="icon-pencil"></i></a>&nbsp
              <a href="<?php echo url_for('materiel/delete?id=' . $materiel->getId()) ?>" class="btn"  rel="tooltip" data-original-title="Supprimer"><i class="icon-remove"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a class="btn" href="<?php echo url_for('materiel_new', $asso) ?>">Ajouter du matériel</a>
  </div>
</div>