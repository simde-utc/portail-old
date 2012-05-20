<h1>Asso members List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Asso</th>
      <th>Role</th>
      <th>Semestre</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($asso_members as $asso_member): ?>
    <tr>
      <td><a href="<?php echo url_for('member/edit?id='.$asso_member->getId()) ?>"><?php echo $asso_member->getId() ?></a></td>
      <td><?php echo $asso_member->getUserId() ?></td>
      <td><?php echo $asso_member->getAssoId() ?></td>
      <td><?php echo $asso_member->getRoleId() ?></td>
      <td><?php echo $asso_member->getSemestreId() ?></td>
      <td><?php echo $asso_member->getCreatedAt() ?></td>
      <td><?php echo $asso_member->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('member/new') ?>">New</a>
