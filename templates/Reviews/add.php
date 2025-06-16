<h4>Leave a Review</h4>

<?= $this->Form->create($review) ?>
    <div class="mb-3">
        <?= $this->Form->control('rating', [
            'type' => 'number',
            'min' => 1,
            'max' => 5,
            'label' => 'Rating (1 to 5)',
            'class' => 'form-control',
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->control('comment', ['type' => 'textarea', 'rows' => 3, 'label' => 'Comment']) ?>
    </div>

    <?= $this->Form->button('Submit Review', ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
