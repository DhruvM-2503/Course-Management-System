<div class="container my-4">
    <div class="card shadow p-4">
        <h2><?= h($lesson->title) ?></h2>
        <p><?= h($lesson->description) ?></p>
        <hr class="m-0">
        <h4>Contents</h4>
        <?php if (!empty($lesson->lesson_contents)) : ?>
            <?php foreach ($lesson->lesson_contents as $content) : ?>
                <div class="mb-3 p-3 border rounded bg-light">
                    <p><?= h($content->content) ?></p>
                </div>
                <?php if ($this->Identity->get('role') === 'user') : ?>
                    <div class="mt-3 p-3 bg-light rounded">
                        <p class="fw-semibold">Learned it? Now test yourself!</p>
                        <?= $this->Html->link(
                            'Take Quiz',
                            ['controller' => 'Quizzes', 'action' => 'start', $lesson->id],
                            ['class' => 'btn btn-sm btn-outline-success']
                        ) ?>
                    </div>
                    <?php else: ?>
                        <div class="d-flex">
                        <?= $this->Html->link(
                            'Add Quiz',
                            ['controller' => 'Quizzes', 'action' => 'add', $lesson->id],
                            ['class' => 'btn btn-sm btn-outline-success'],
                        ) ?>
                        <?= $this->Html->link(
                            'View Quiz',
                            ['controller' => 'Quizzes', 'action' => 'start', $lesson->id],
                            ['class' => 'btn btn-sm btn-outline-primary mx-3'],
                        ) ?>
                        </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-muted">No content available for this lesson.</p>
        <?php endif; ?>
    </div>
</div>
