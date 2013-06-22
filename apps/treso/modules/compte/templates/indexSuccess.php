<h1>Comptes bancaires de l'association <?php echo $asso ?></h1>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Banque</th>
      <th>Num compte</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($compte_banquaires as $compte_banquaire): ?>
      <tr>
        <td><?php echo $compte_banquaire->getNom() ?></td>
        <td><?php echo $compte_banquaire->getBanque() ?></td>
        <td><?php echo $compte_banquaire->getNumCompte() ?></td>
        <td>
          <div class="btn-group">
            <a href="<?php echo url_for('compte/edit?id=' . $compte_banquaire->getId()) ?>" class="btn"><i class="icon-pencil"></i>&nbsp;&nbsp;Editer</a>
            <?php echo link_to('<i class="icon-trash icon-white"></i>', 'compte/delete?id=' . $compte_banquaire->getId(), array('method' => 'delete', 'confirm' => 'Voulez-vous vraiment supprimer ce compte ?', 'class' => 'btn btn-danger')) ?>
          </div>
        </td> 
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<a href="<?php echo url_for('compte_new', $asso) ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i>&nbsp;&nbsp;Nouveau</a>
