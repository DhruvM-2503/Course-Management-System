<h4>Contents</h4>
<?php if (!empty($lesson->lesson_contents)) : ?>
<?php foreach ($lesson->lesson_contents as $content): ?>
    <div class="border p-2 mb-2">
        <p><?= h($content->content) ?></p>
        <?= $this->Html->link('Edit', ['controller' => 'LessonContents', 'action' => 'edit', $content->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
        <?= $this->Form->postLink('Delete', ['controller' => 'LessonContents', 'action' => 'delete', $content->id], ['class' => 'btn btn-sm btn-outline-danger', 'confirm' => 'Are you sure?']) ?>
    </div>
<?php endforeach; ?>
<?php else: ?>
    <p class="text-muted">No content added yet.</p>
    <?php if ($this->Identity->get('role') === 'admin') : ?>
<?= $this->Html->link(
    '<i class="fa fa-plus"></i> Add Content',
    ['controller' => 'LessonContents', 'action' => 'add', $lesson->id],
    ['class' => 'btn btn-success my-3', 'escape' => false]
) ?>
<?php endif; ?>
<?php endif; ?> 