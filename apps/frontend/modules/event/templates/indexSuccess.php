<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Asso</th>
      <th>Type</th>
      <th>Name</th>
      <th>Description</th>
      <th>Start date</th>
      <th>End date</th>
      <th>Is public</th>
      <th>Is weekmail</th>
      <th>Place</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>"><?php echo $event->getId() ?></a></td>
      <td><?php echo $event->getAsso() ?></td>
      <td><?php echo $event->getType() ?></td>
      <td><?php echo $event->getName() ?></td>
      <td><?php echo html_entity_decode($event->getDescription()) ?></td>
      <td><?php echo $event->getStartDate() ?></td>
      <td><?php echo $event->getEndDate() ?></td>
      <td><?php echo $event->getIsPublic() ?></td>
      <td><?php echo $event->getIsWeekmail() ?></td>
      <td><?php echo $event->getPlace() ?></td>
      <td><?php echo $event->getCreatedAt() ?></td>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('event/new') ?>">New</a>
