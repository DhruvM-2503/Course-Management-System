<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonContent $lessonContent
 * @var string[]|\Cake\Collection\CollectionInterface $lessons
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lessonContent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonContent->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lesson Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessonContents form content">
            <?= $this->Form->create($lessonContent) ?>
            <fieldset>
                <legend><?= __('Edit Lesson Content') ?></legend>
                <?php
                    echo $this->Form->control('lesson_id', ['options' => $lessons]);
                    echo $this->Form->control('content_type');
                    echo $this->Form->control('content');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
