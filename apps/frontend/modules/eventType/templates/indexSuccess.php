<h1>Event types List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Color</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($event_types as $event_type): ?>
    <tr>
      <td><a href="<?php echo url_for('eventType/edit?id='.$event_type->getId()) ?>"><?php echo $event_type->getId() ?></a></td>
      <td><?php echo $event_type->getName() ?></td>
      <td><?php echo $event_type->getColor() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('eventType/new') ?>">New</a>
