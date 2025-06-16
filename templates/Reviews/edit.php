<div class="container my-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Edit Your Review</h2>

        <?= $this->Form->create($review) ?>

        <?= $this->Form->control('rating', [
            'label' => 'Rating (1 to 5)',
            'type' => 'number',
            'min' => 1,
            'max' => 5,
            'class' => 'form-control',
        ]) ?>

        <?= $this->Form->control('comment', [
            'type' => 'textarea',
            'label' => 'Your Comment',
            'rows' => 4,
            'class' => 'form-control review',
        ]) ?>

        <?= $this->Form->button(__('Submit')) ?>

        <?= $this->Html->link(
            '<i class="fa fa-arrow-left"></i> Cancel',
            ['controller' => 'Courses', 'action' => 'view', $review->course_id],
            ['class' => 'btn btn-secondary mt-3 ms-2', 'escape' => false]
        ) ?>

        <?= $this->Form->end() ?>
    </div>
</div>
