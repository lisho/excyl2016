<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClasificadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClasificadosTable Test Case
 */
class ClasificadosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClasificadosTable
     */
    public $Clasificados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clasificados',
        'app.candidatos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Clasificados') ? [] : ['className' => 'App\Model\Table\ClasificadosTable'];
        $this->Clasificados = TableRegistry::get('Clasificados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Clasificados);

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
