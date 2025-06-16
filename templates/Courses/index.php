<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Courses</h2>
        <?= $this->Html->link('<i class="fa-solid fa-plus"></i> Add Course', ['action' => 'add'], ['class' => 'add', 'escape' => false]) ?>
    </div>

    <?php if ($courses->isEmpty()): ?>
        <div class="alert alert-warning">No courses available yet.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($courses as $course): ?>
                <div class="col">
                    <div class="card shadow-sm h-100 border-0">
                        <?php if ($course->thumbnail): ?>
                            <?= $this->Html->image(
                                'courses/' . $course->thumbnail,
                                ['class' => 'card-img-top rounded-top', 'alt' => $course->title, 'style' => 'height:200px;object-fit:contain;']
                            ) ?>
                        <?php else: ?>
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height:200px;">
                                No Image
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title text-dark"><?= h($course->title) ?></h5>
                            <p class="card-text text-muted"><?= h($course->description) ?></p>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <?= $this->Html->link(
                                '<i class="fa-solid fa-pen-to-square"></i> Edit',
                                ['action' => 'edit', $course->id],
                                ['class' => 'edit', 'escape' => false]
                            ) ?>
                            <?= $this->Html->link(
                                '<i class="fa-solid fa-eye"></i> View',
                                ['action' => 'view', $course->id],
                                ['class' => 'view', 'escape' => false]
                            ) ?>
                            <?= $this->Form->postLink(
                                '<i class="fa-solid fa-trash"></i> Delete',
                                ['action' => 'delete', $course->id],
                                ['class' => 'delete','escape' => false, 'confirm' => 'Are you sure you want to delete this course?']
                            ) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
