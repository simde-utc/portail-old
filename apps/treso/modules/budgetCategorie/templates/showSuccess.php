<table>
  <tbody>
    <tr>
      <th>Asso:</th>
      <td><?php echo $asso->getName() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $categorie->getNom() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('budgetCategorie/edit?id='.$budget_categorie->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('budgetCategorie/index') ?>">List</a>
