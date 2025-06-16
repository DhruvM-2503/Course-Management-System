<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QuizzesFixture
 */
class QuizzesFixture extends TestFixture
{
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
                'lesson_id' => 1,
                'question' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'option_a' => 'Lorem ipsum dolor sit amet',
                'option_b' => 'Lorem ipsum dolor sit amet',
                'option_c' => 'Lorem ipsum dolor sit amet',
                'option_d' => 'Lorem ipsum dolor sit amet',
                'correct_option' => '',
                'created' => '2025-06-11 05:03:22',
                'modified' => '2025-06-11 05:03:22',
            ],
        ];
        parent::init();
    }
}
