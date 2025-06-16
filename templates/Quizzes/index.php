<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Quiz> $quizzes
 */
?>
<div class="quizzes index content">
    <?= $this->Html->link(__('New Quiz'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Quizzes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('lesson_id') ?></th>
                    <th><?= $this->Paginator->sort('option_a') ?></th>
                    <th><?= $this->Paginator->sort('option_b') ?></th>
                    <th><?= $this->Paginator->sort('option_c') ?></th>
                    <th><?= $this->Paginator->sort('option_d') ?></th>
                    <th><?= $this->Paginator->sort('correct_option') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $quiz): ?>
                <tr>
                    <td><?= $this->Number->format($quiz->id) ?></td>
                    <td><?= $quiz->hasValue('lesson') ? $this->Html->link($quiz->lesson->title, ['controller' => 'Lessons', 'action' => 'view', $quiz->lesson->id]) : '' ?></td>
                    <td><?= h($quiz->option_a) ?></td>
                    <td><?= h($quiz->option_b) ?></td>
                    <td><?= h($quiz->option_c) ?></td>
                    <td><?= h($quiz->option_d) ?></td>
                    <td><?= h($quiz->correct_option) ?></td>
                    <td><?= h($quiz->created) ?></td>
                    <td><?= h($quiz->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $quiz->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $quiz->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $quiz->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $quiz->id),
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