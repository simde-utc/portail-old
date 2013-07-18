<h1>Charte locauxs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Ip</th>
      <th>Semestre</th>
      <th>Pole</th>
      <th>Asso</th>
      <th>Asso name</th>
      <th>Login</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Porte mde</th>
      <th>Bat a</th>
      <th>Locaux pic</th>
      <th>Mde complete</th>
      <th>Bureau polar</th>
      <th>Perm polar</th>
      <th>Salles musique</th>
      <th>Statut</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($charte_locauxs as $charte_locaux): ?>
    <tr>
      <td><a href="<?php echo url_for('locaux/edit?id='.$charte_locaux->getId()) ?>"><?php echo $charte_locaux->getId() ?></a></td>
      <td><?php echo $charte_locaux->getDate() ?></td>
      <td><?php echo $charte_locaux->getIp() ?></td>
      <td><?php echo $charte_locaux->getSemestreId() ?></td>
      <td><?php echo $charte_locaux->getPoleId() ?></td>
      <td><?php echo $charte_locaux->getAssoId() ?></td>
      <td><?php echo $charte_locaux->getAssoName() ?></td>
      <td><?php echo $charte_locaux->getLogin() ?></td>
      <td><?php echo $charte_locaux->getNom() ?></td>
      <td><?php echo $charte_locaux->getPrenom() ?></td>
      <td><?php echo $charte_locaux->getPorteMde() ?></td>
      <td><?php echo $charte_locaux->getBatA() ?></td>
      <td><?php echo $charte_locaux->getLocauxPic() ?></td>
      <td><?php echo $charte_locaux->getMdeComplete() ?></td>
      <td><?php echo $charte_locaux->getBureauPolar() ?></td>
      <td><?php echo $charte_locaux->getPermPolar() ?></td>
      <td><?php echo $charte_locaux->getSallesMusique() ?></td>
      <td><?php echo $charte_locaux->getStatut() ?></td>
      <td><?php echo $charte_locaux->getCreatedAt() ?></td>
      <td><?php echo $charte_locaux->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('locaux/new') ?>">New</a>
