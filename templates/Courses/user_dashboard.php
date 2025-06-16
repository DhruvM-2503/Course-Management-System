<div class="container mt-5">
    <h2 class="text-success mb-4">Welcome, <?= h($this->Identity->get('username')) ?>!</h2>
    <h4>Your Enrolled Courses</h4>

    <?php if (empty($user->courses)): ?>
        <div class="alert alert-info mt-3">You haven't enrolled in any courses yet.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
            <?php foreach ($user->courses as $course): ?>
                <?php
                    $totalLessons = count($course->lessons);
                    $completed = 0;
                    foreach ($course->lessons as $lesson) {
                        if (!empty($progress[$lesson->id])) {
                            $completed++;
                        }
                    }
                    $percentage = $totalLessons > 0 ? round(($completed / $totalLessons) * 100) : 0;
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($course->thumbnail)): ?>
                            <?= $this->Html->image('courses/' . $course->thumbnail, [
                                'class' => 'card-img-top w-100',
                                'style' => 'height: 200px; object-fit: contain;',
                                'alt' => $course->title
                            ]) ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= h($course->title) ?></h5>
                            <p class="card-text"><?= $this->Text->truncate($course->description, 100) ?></p>

                            <div class="mb-2">
                                <strong>Progress:</strong> <?= $completed ?>/<?= $totalLessons ?> lessons (<?= $percentage ?>%)
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?= $percentage ?>%; height: 100%;" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $percentage ?>%
                                    </div>
                                </div>
                            </div>

                            <?= $this->Html->link('View Course', ['controller' => 'Courses', 'action' => 'view', $course->id], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                            <?= $this->Form->postLink('Unenroll', ['controller' => 'Enrollments', 'action' => 'delete', $course->id], [
                                'confirm' => 'Are you sure you want to unenroll?',
                                'class' => 'btn btn-outline-danger btn-sm ms-2'
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
