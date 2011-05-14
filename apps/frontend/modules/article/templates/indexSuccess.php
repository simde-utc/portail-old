<h1>Articles List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Asso</th>
      <th>Name</th>
      <th>Text</th>
      <th>Is weekmail</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($articles as $article): ?>
    <tr>
      <td><a href="<?php echo url_for('article/edit?id='.$article->getId()) ?>"><?php echo $article->getId() ?></a></td>
      <td><?php echo $article->getAsso()->getName() ?></td>
      <td><?php echo $article->getName() ?></td>
      <td><?php echo $article->getText() ?></td>
      <td><?php echo $article->getIsWeekmail() ?></td>
      <td><?php echo $article->getCreatedAt() ?></td>
      <td><?php echo $article->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('article/new') ?>">New</a>
