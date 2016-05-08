<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CeasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CeasTable Test Case
 */
class CeasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CeasTable
     */
    public $Ceas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ceas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ceas') ? [] : ['className' => 'App\Model\Table\CeasTable'];
        $this->Ceas = TableRegistry::get('Ceas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ceas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
