<div class="container mt-5">
    <div class="card shadow p-4">
        <h2><?= isset($course->id) ? 'Edit Course' : 'Add Course' ?></h2>

        <?= $this->Form->create($course, ['type' => 'file']) ?>

        <div class="mb-3">
            <?= $this->Form->control('title', ['label' => 'Course Title', 'class' => 'form-control text', 'style' => 'font-size:1.5rem;']) ?>
        </div>

        <div class="mb-3">
            <?= $this->Form->control('description', ['label' => 'Description', 'class' => 'form-control', 'rows' => 4, 'style' => 'font-size:1.5rem;']) ?>
        </div>

        <div class="mb-3">
            <?= $this->Form->control('thumbnail', ['type' => 'file', 'label' => 'Course Thumbnail', 'class' => 'form-control']) ?>
        </div>

        <div>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>
