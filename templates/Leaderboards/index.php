<div class="container text-center mt-5">
    <h2 class="mb-4"> Course Leaderboard</h2>

    <?php if (!empty($leaderboard)): ?>
        <table class="table table-bordered table-striped w-75 mx-auto shadow-lg">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>User Name</th>
                    <th>Total Completed Quizzes</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $currentUserId = $this->Identity->get('id');
                foreach ($leaderboard as $index => $entry): 
                ?>
                    <tr>
                        <td><strong>#<?= $index + 1 ?></strong></td>
                        <td><?=  h($entry['user']->username) ?></td>
                        <td><?= h($entry['score']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No data available yet. Complete lessons to appear on the leaderboard!</p>
    <?php endif; ?>
</div>
