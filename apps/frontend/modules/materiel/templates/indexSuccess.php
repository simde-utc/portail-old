<div class="part">
  <h1>Liste de matériel</h1>
  <div class="well">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Disponible</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($materiels as $materiel): ?>
          <tr>
            <td><?php echo $materiel->getNom() ?></td>
            <td><?php echo $materiel->getDescription() ?></td>
            <td><?php echo $materiel->getStockDisponible() ?></td>
            <td>
              <a href="<?php echo url_for('emprunt_new',$materiel) ?>" class="btn" rel="tooltip" data-original-title="Emprunter"><i class="icon-share-alt"></i></a>&nbsp
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

  <h1>Liste des emprunts</h1>
  <div class="well">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Matériel</th>
          <th>Emprunteur</th>
          <th>Quantité</th>
          <th>Date d'emprunt</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($emprunts as $emprunt): ?>
          <tr>
            <td><?php echo $emprunt->getMateriel()->getNom() ?></td>
            <td><?php echo $emprunt->getUser() ?></td>
            <td><?php echo $emprunt->getNombre() ?></td>
            <td><?php echo $emprunt->getCreatedAt() ?></td>
            <td>
               <a href="<?php echo url_for('emprunt/rendre?id=' . $emprunt->getId()) ?>" class="btn" rel="tooltip" data-original-title="Rendre"><i class="icon-arrow-left"></i></a>&nbsp
              <?php echo link_to('<i class="icon-trash"></i>', 'emprunt/delete?id='.$emprunt->getId(), array('method' => 'delete', 'confirm' => 'Annuler l\'emprunt ?', 'class' => 'btn','rel'=>'tooltip','data-original-title'=>"Editer")) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>