<div class="container mt-5">
    <h2 class="text-primary mb-4">Admin Dashboard - Enrollments & Progress Overview</h2>

    <?php foreach ($courses as $course): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><?= h($course->title) ?></h4>
                <p><strong>Total Lessons:</strong> <?= count($course->lessons) ?></p>
                <p><strong>Enrolled Users:</strong> <?= count($course->users) ?></p>

                <?php if (!empty($course->users)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($course->users as $user): ?>
                            <?php
                                $totalLessons = count($course->lessons);
                                $passedCount = 0;

                                foreach ($course->lessons as $lesson) {
                                    foreach ($lesson->lesson_user_progress as $progress) {
                                        if (
                                            $progress->user_id == $user->id &&
                                            $progress->quiz_passed == 1
                                        ) {
                                            $passedCount++;
                                        }
                                    }
                                }

                                $progressPercent = $totalLessons > 0 ? round(($passedCount / $totalLessons) * 100) : 0;
                            ?>
                            <li class="list-group-item">
                                <strong><?= h($user->username) ?></strong> (<?= h($user->email) ?>)
                                <div class="progress mt-2" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progressPercent ?>%;">
                                        <?= $progressPercent ?>%
                                    </div>
                                </div>
                                <small><?= $passedCount ?> / <?= $totalLessons ?> lessons completed</small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="text-muted">No users enrolled yet.</div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
