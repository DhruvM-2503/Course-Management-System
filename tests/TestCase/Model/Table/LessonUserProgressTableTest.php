<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonUserProgressTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonUserProgressTable Test Case
 */
class LessonUserProgressTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonUserProgressTable
     */
    protected $LessonUserProgress;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.LessonUserProgress',
        'app.Users',
        'app.Lessons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LessonUserProgress') ? [] : ['className' => LessonUserProgressTable::class];
        $this->LessonUserProgress = $this->getTableLocator()->get('LessonUserProgress', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LessonUserProgress);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LessonUserProgressTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LessonUserProgressTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
