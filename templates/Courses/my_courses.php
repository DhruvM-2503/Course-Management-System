<div class="container mt-5">
    <h2>My Enrolled Courses</h2>

    <?php if (empty($courses)) : ?>
        <div class="alert alert-info mt-3">You haven't enrolled in any courses yet.</div>
    <?php else : ?>
        <div class="row">
            <?php foreach ($courses as $course) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($course->thumbnail)) : ?>
                            <?= $this->Html->image('courses/' . $course->thumbnail, ['class' => 'card-img-top myImg', 'alt' => h($course->title)]) ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= h($course->title) ?></h5>
                            <p class="card-text"><?= $this->Text->truncate(h($course->description), 100) ?></p>
                            <?= $this->Html->link('View Course', ['action' => 'view', $course->id], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
