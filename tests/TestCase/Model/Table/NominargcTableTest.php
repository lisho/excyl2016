<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NominargcTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NominargcTable Test Case
 */
class NominargcTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NominargcTable
     */
    public $Nominargc;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nominargc'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Nominargc') ? [] : ['className' => 'App\Model\Table\NominargcTable'];
        $this->Nominargc = TableRegistry::get('Nominargc', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nominargc);

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
