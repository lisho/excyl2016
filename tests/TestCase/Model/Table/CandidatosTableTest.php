<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatosTable Test Case
 */
class CandidatosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatosTable
     */
    public $Candidatos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Candidatos') ? [] : ['className' => 'App\Model\Table\CandidatosTable'];
        $this->Candidatos = TableRegistry::get('Candidatos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidatos);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
