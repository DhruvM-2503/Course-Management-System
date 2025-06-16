<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonContent $lessonContent
 * @var \Cake\Collection\CollectionInterface|string[] $lessons
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lesson Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessonContents form content">
            <?= $this->Form->create($lessonContent) ?>
            <fieldset>
                <legend><?= __('Add Lesson Content') ?></legend>
                <?php
                    echo $this->Form->control('lesson_id', [
    'label' => 'Select Lesson',
    'options' => $lessons,
    'empty' => 'Select a lesson'
]);
                    echo $this->Form->control('content_type');
                    echo $this->Form->control('content');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
