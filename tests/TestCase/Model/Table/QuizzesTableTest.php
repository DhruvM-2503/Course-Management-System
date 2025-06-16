<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuizzesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuizzesTable Test Case
 */
class QuizzesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuizzesTable
     */
    protected $Quizzes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Quizzes',
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
        $config = $this->getTableLocator()->exists('Quizzes') ? [] : ['className' => QuizzesTable::class];
        $this->Quizzes = $this->getTableLocator()->get('Quizzes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Quizzes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\QuizzesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\QuizzesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
