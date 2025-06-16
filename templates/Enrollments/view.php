<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enrollment $enrollment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Enrollment'), ['action' => 'edit', $enrollment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Enrollment'), ['action' => 'delete', $enrollment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enrollment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Enrollments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Enrollment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="enrollments view content">
            <h3><?= h($enrollment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $enrollment->hasValue('user') ? $this->Html->link($enrollment->user->username, ['controller' => 'Users', 'action' => 'view', $enrollment->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Course') ?></th>
                    <td><?= $enrollment->hasValue('course') ? $this->Html->link($enrollment->course->title, ['controller' => 'Courses', 'action' => 'view', $enrollment->course->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($enrollment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Enrolled On') ?></th>
                    <td><?= h($enrollment->enrolled_on) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>