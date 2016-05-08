<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiagnosticosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiagnosticosTable Test Case
 */
class DiagnosticosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DiagnosticosTable
     */
    public $Diagnosticos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.diagnosticos',
        'app.candidatos',
        'app.ceas',
        'app.clasificados'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Diagnosticos') ? [] : ['className' => 'App\Model\Table\DiagnosticosTable'];
        $this->Diagnosticos = TableRegistry::get('Diagnosticos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diagnosticos);

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
