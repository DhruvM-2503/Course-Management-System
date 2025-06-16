<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LessonUserProgressFixture
 */
class LessonUserProgressFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'lesson_user_progress';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'lesson_id' => 1,
                'quiz_passed' => 1,
                'completed_at' => '2025-06-11 09:50:47',
            ],
        ];
        parent::init();
    }
}
