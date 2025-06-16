<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LessonContent> $lessonContents
 */
?>
<div class="lessonContents index content">
    <?= $this->Html->link(__('New Lesson Content'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lesson Contents') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('lesson_id') ?></th>
                    <th><?= $this->Paginator->sort('content_type') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessonContents as $lessonContent): ?>
                <tr>
                    <td><?= $this->Number->format($lessonContent->id) ?></td>
                    <td><?= $lessonContent->hasValue('lesson') ? $this->Html->link($lessonContent->lesson->title, ['controller' => 'Lessons', 'action' => 'view', $lessonContent->lesson->id]) : '' ?></td>
                    <td><?= h($lessonContent->content_type) ?></td>
                    <td><?= h($lessonContent->created) ?></td>
                    <td><?= h($lessonContent->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lessonContent->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lessonContent->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $lessonContent->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $lessonContent->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>