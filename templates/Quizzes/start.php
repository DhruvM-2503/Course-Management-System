<?= $this->Form->create(null, ['url' => ['action' => 'submit']]) ?>
    <input type="hidden" name="lesson_id" value="<?= h($lessonId) ?>">

    <?php foreach ($questions as $q): ?>
        <div class="mb-5">
            <p class="m-0 mt-3"><strong><?= h($q->question) ?></strong></p>
            <?php foreach (['A', 'B', 'C', 'D'] as $opt): ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                            name="answers[<?= $q->id ?>]"
                            value="<?= $opt ?>" required>
                    <label class="form-check-label">
                        <?= h($q->{'option_' . strtolower($opt)}) ?>
                    </label>
                </div>
            <?php endforeach; ?>
            <?php if ($this->Identity->get('role') === 'admin') : ?>
                        <?= $this->Html->link(
                            'Edit Question',
                            ['controller' => 'Quizzes', 'action' => 'edit', $q->id],
                            ['class' => 'btn btn-sm btn-outline-success']
                        ) ?>
                        <?= $this->Form->postLink(
                            'Delete Question',
                            ['controller' => 'Quizzes', 'action' => 'delete', $q->id],
                            ['confirm' => 'Are you sure?', 'class' => 'btn btn-sm btn-outline-danger']
                        ) ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
    <button type="submit" class="btn btn-primary">Submit Quiz</button>
<?= $this->Form->end() ?>
