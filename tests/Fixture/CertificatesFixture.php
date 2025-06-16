<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CertificatesFixture
 */
class CertificatesFixture extends TestFixture
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
                'user_id' => 1,
                'course_id' => 1,
                'issued_at' => '2025-06-13 05:30:07',
                'certificate_path' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
