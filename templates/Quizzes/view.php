<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quiz $quiz
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Quiz'), ['action' => 'edit', $quiz->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Quiz'), ['action' => 'delete', $quiz->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quiz->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Quizzes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Quiz'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="quizzes view content">
            <h3><?= h($quiz->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Lesson') ?></th>
                    <td><?= $quiz->hasValue('lesson') ? $this->Html->link($quiz->lesson->title, ['controller' => 'Lessons', 'action' => 'view', $quiz->lesson->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Option A') ?></th>
                    <td><?= h($quiz->option_a) ?></td>
                </tr>
                <tr>
                    <th><?= __('Option B') ?></th>
                    <td><?= h($quiz->option_b) ?></td>
                </tr>
                <tr>
                    <th><?= __('Option C') ?></th>
                    <td><?= h($quiz->option_c) ?></td>
                </tr>
                <tr>
                    <th><?= __('Option D') ?></th>
                    <td><?= h($quiz->option_d) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correct Option') ?></th>
                    <td><?= h($quiz->correct_option) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($quiz->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($quiz->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($quiz->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Question') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($quiz->question)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>