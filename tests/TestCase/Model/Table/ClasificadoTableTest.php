<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClasificadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClasificadoTable Test Case
 */
class ClasificadoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClasificadoTable
     */
    public $Clasificado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.clasificado',
        'app.candidatos',
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
        $config = TableRegistry::exists('Clasificado') ? [] : ['className' => 'App\Model\Table\ClasificadoTable'];
        $this->Clasificado = TableRegistry::get('Clasificado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Clasificado);

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
