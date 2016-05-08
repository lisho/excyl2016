<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Excyl2016Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Excyl2016Table Test Case
 */
class Excyl2016TableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Excyl2016Table
     */
    public $Excyl2016;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.excyl2016'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Excyl2016') ? [] : ['className' => 'App\Model\Table\Excyl2016Table'];
        $this->Excyl2016 = TableRegistry::get('Excyl2016', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Excyl2016);

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
