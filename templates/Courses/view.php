<div class="container my-5">
    <div class="card shadow">
        <div class="row g-0">
            <?php if (!empty($course->thumbnail)) : ?>
                <div class="col-md-4 col-12">
                    <?= $this->Html->image('courses/' . $course->thumbnail, [
                        'class' => 'img-fluid rounded-start w-100',
                        'alt' => h($course->title),
                        'style' => 'height: 100%; object-fit: contain; max-height: 250px;'
                    ]) ?>
                </div>
            <?php endif; ?>

            <div class="<?= !empty($course->thumbnail) ? 'col-md-8' : 'col-12' ?> p-3 d-flex flex-column">
                <div class="card-body flex-grow-1">
                    <h3 class="card-title"><?= h($course->title) ?></h3>
                    <p class="card-text"><?= h($course->description) ?></p>

                    <?php if (isset($course->user)) : ?>
                        <p class="card-text text-muted mb-1">
                            <i class="fa fa-user me-1"></i>
                            Created by: <?= h($course->user->username ?? 'Unknown') ?>
                        </p>
                    <?php endif; ?>

                    <p class="card-text text-muted mb-3">
                        <i class="fa fa-user-graduate me-1"></i>
                        <?= count($course->users) ?> enrolled
                    </p>

                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <?php if (!$this->Identity->isLoggedIn()) : ?>
                            <p class="mb-0">
                                Please <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login', 'plugin' => false]) ?>">login</a> to enroll.
                            </p>
                        <?php else : ?>
                            <?php
                                $currentUser = $this->Identity->get('id');
                                $isEnrolled = false;
                                foreach ($course->users ?? [] as $user) {
                                    if ($user->id == $currentUser) {
                                        $isEnrolled = true;
                                        break;
                                    }
                                }
                            ?>
                            <button id="enrollBtn"
                                class="btn pt-0 <?= $isEnrolled ? 'btn-outline-danger' : 'btn-success' ?>"
                                data-enrolled="<?= $isEnrolled ? 'yes' : 'no' ?>"
                                data-course-id="<?= $course->id ?>">
                            <i class="fa-solid <?= $isEnrolled ? 'fa-user-minus' : 'fa-user-plus' ?>"></i>
                            <?= $isEnrolled ? 'Un-Enroll' : 'Enroll Now' ?>
                            </button>
                            <?php if ($isEnrolled) : ?>
                                <a href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'add', $course->id]) ?>"
                                    class="btn btn-warning rev">
                                    <i class="fa-solid fa-star"></i> Add Review
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back to Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Section -->
        <div class="card-footer bg-white border-top">
            <h4 class="mt-4">Reviews</h4>
            <div class="reviews-box mt-3 p-3 border rounded bg-light" style="max-height: 300px; overflow-y: auto;">
                <?php if (empty($course->reviews)) : ?>
                    <p class="text-muted">No reviews yet.</p>
                <?php else : ?>
                    <?php foreach ($course->reviews as $review) : ?>
                        <div class="mb-3 p-2 border-bottom">
                            <strong><?= h($review->user->username) ?></strong><br>
                            <div class="text-warning mb-1">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <i class="fa<?= $i <= $review->rating ? 's' : 'r' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="mb-0"><?= h($review->comment) ?></p>

                            <?php if ($this->Identity->get('id') === $review->user_id) : ?>
                                <div class="d-flex gap-2 mt-2">
                                    <?= $this->Html->link(
                                        '<i class="fa fa-edit"></i> Edit',
                                        ['controller' => 'Reviews', 'action' => 'edit', $review->id],
                                        ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]
                                    ) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="fa fa-trash"></i> Delete',
                                        ['controller' => 'Reviews', 'action' => 'delete', $review->id],
                                        ['class' => 'btn btn-sm btn-outline-danger', 'escape' => false, 'confirm' => 'Are you sure you want to delete this review?']
                                    ) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

<!-- Lessons Section -->
 <?php if($isEnrolled || ($this->Identity->get('role') === 'admin')): ?>
<div class="card-footer bg-white border-top">
    <h4 class="mt-4">Lessons</h4>
    <div class="lessons-box mt-3 p-3 border rounded bg-light">
        <?php if (empty($course->lessons)) : ?>
            <p class="text-muted">No lessons added yet.</p>
            <?php if ($this->Identity->get('role') === 'admin') : ?>
                <?= $this->Html->link(
                    '<i class="fa fa-plus"></i> Add Lesson',
                    ['controller' => 'Lessons', 'action' => 'add', $course->id],
                    ['class' => 'btn btn-success my-3', 'escape' => false]
                ) ?>
            <?php endif; ?>
        <?php else : ?>
            <!-- Lesson Manipulation code -->
            <?php foreach ($course->lessons as $lesson) : ?>
                <div class="mb-3 p-2 border-bottom">
                    <h5><?= h($lesson->title) ?></h5>
                    <p class="mb-0">Summary: <?= h($lesson->description) ?></p>

        <?php if ($this->Identity->get('role') === 'admin') : ?>
            <!-- Admin buttons -->
            <div class="d-flex gap-2 mt-2">
                <?= $this->Html->link('Edit', ['controller' => 'Lessons', 'action' => 'edit', $lesson->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                <?= $this->Form->postLink('Delete', ['controller' => 'Lessons', 'action' => 'delete', $lesson->id], ['class' => 'btn btn-sm btn-outline-danger', 'confirm' => 'Delete this lesson?']) ?>
                <?= $this->Html->link('View', ['controller' => 'Lessons', 'action' => 'learn', $lesson->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?php if (!empty($lesson->lesson_contents)) : ?>
                    <?= $this->Html->link(
                        'Edit Content',
                        ['controller' => 'LessonContents', 'action' => 'edit', $lesson->lesson_contents[0]->id],
                        ['class' => 'btn btn-sm btn-outline-secondary']
                    ) ?>
                <?php else : ?>
                    <?= $this->Html->link(
                        'Add Content',
                        ['controller' => 'LessonContents', 'action' => 'add', $lesson->id],
                        ['class' => 'btn btn-sm btn-outline-success']
                    ) ?>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <!-- User: Learn button -->
            <div class="mt-2">
                <?= $this->Html->link('Learn', ['controller' => 'Lessons', 'action' => 'learn', $lesson->id], ['class' => 'btn btn-sm btn-primary']) ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
            <?php if ($this->Identity->get('role') === 'admin') : ?>
                <div class="mt-3">
                    <?= $this->Html->link(
                        '<i class="fa fa-plus"></i> Add More Lessons',
                        ['controller' => 'Lessons', 'action' => 'add', $course->id],
                        ['class' => 'btn btn-outline-success', 'escape' => false]
                    ) ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
    <div class="lessons-box mt-3 p-3 border rounded bg-light">
        <p>Enroll now to see the content of this course</p>
    </div>
<?php endif; ?>
<?php
use Cake\ORM\TableRegistry;
$lessonsTable = TableRegistry::getTableLocator()->get('Lessons');
$progressTable = TableRegistry::getTableLocator()->get('LessonUserProgress');

$lessonIds = $lessonsTable->find()
    ->select(['id'])
    ->where(['course_id' => $course->id])
    ->all()
    ->extract('id')
    ->toList();

$total = count($lessonIds);

$passed = $progressTable->find()
    ->where([
        'user_id' => $this->Identity->get('id'),
        'lesson_id IN' => $lessonIds,
        'quiz_passed' => 1
    ])
    ->count();
?>

<?php if ($total > 0 && $passed === $total): ?>
    <div class="lessons-box mt-3 p-3 border rounded bg-light">
        <div class="alert alert-success">
            <p>Congratulations you have completed the course, download your certificate</p>
        </div>
    <a href="<?= $this->Url->build(['controller' => 'Certificates', 'action' => 'generate', $course->id]) ?>"
       class="btn btn-success btn-sm mt-4 p-2 certi">
        <i class="fa fa-certificate"></i> Download Certificate
    </a>
    <?php elseif($this->Identity->get('role') === 'admin') : ?>
                <div class="mt-3 border p-3 bg-light rounded">
                <?= $this->Html->link(
                        'Edit Certificates',
                        ['controller' => 'Certificates', 'action' => 'edit', $lesson->lesson_contents[0]->id],
                        ['class' => 'btn btn-sm btn-outline-secondary']
                    ) ?>
                    </div>
                </div>
        <?php else: ?>
            <div class="lessons-box mt-3 p-3 border rounded bg-light">
                <p>Complete all the quizzes to download certificate</p>
            </div>
        <?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const enrollBtn = document.getElementById("enrollBtn");

    if (enrollBtn) {
        enrollBtn.addEventListener("click", function () {
            const courseId = this.dataset.courseId;
            const enrolled = this.dataset.enrolled === "yes";

            fetch("<?= $this->Url->build('/enrollments/toggle-ajax') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": <?= json_encode($this->request->getAttribute('csrfToken')) ?>
                },
                body: JSON.stringify({ course_id: <?= $course->id ?>})
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "enrolled") {
                    enrollBtn.innerHTML = '<i class="fa-solid fa-user-minus"></i> Un-Enroll';
                    enrollBtn.className = "btn btn-outline-danger";
                    enrollBtn.dataset.enrolled = "yes";
                    location.reload();
                } else if (data.status === "unenrolled") {
                    enrollBtn.innerHTML = '<i class="fa-solid fa-user-plus"></i> Enroll Now';
                    enrollBtn.className = "btn btn-success";
                    enrollBtn.dataset.enrolled = "no";
                    location.reload();
                } else {
                    alert(data.message || "Something went wrong.");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Error occurred.");
            });
        });
    }
});

// Success message 
document.addEventListener("DOMContentLoaded", function () {
    const alertBox = document.querySelector(".alert-success");
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = 0;
            setTimeout(() => alertBox.remove(), 500);
        }, 5000);
    }
});
</script>

