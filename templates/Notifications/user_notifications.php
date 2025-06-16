<h3>Your Notifications</h3>
<ul class="list-group">
<?php foreach ($notifications as $note): ?>
    <li class="list-group-item <?= $note->is_read ? '' : 'list-group-item-warning' ?>">
        <strong><?= h($note->title) ?></strong>
        <p><?= h($note->message) ?></p>
        <small><?= $note->created->nice() ?></small>
    </li>
<?php endforeach; ?>
</ul>
