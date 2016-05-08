<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreoposicionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreoposicionTable Test Case
 */
class PreoposicionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PreoposicionTable
     */
    public $Preoposicion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.preoposicion'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Preoposicion') ? [] : ['className' => 'App\Model\Table\PreoposicionTable'];
        $this->Preoposicion = TableRegistry::get('Preoposicion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Preoposicion);

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
