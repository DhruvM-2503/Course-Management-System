<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonContent $lessonContent
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lesson Content'), ['action' => 'edit', $lessonContent->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lesson Content'), ['action' => 'delete', $lessonContent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonContent->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lesson Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lesson Content'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessonContents view content">
            <h3><?= h($lessonContent->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Lesson') ?></th>
                    <td><?= $lessonContent->hasValue('lesson') ? $this->Html->link($lessonContent->lesson->title, ['controller' => 'Lessons', 'action' => 'view', $lessonContent->lesson->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Content Type') ?></th>
                    <td><?= h($lessonContent->content_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lessonContent->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($lessonContent->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($lessonContent->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($lessonContent->content)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>