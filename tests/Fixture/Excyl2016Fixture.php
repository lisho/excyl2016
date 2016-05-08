<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Excyl2016Fixture
 *
 */
class Excyl2016Fixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'excyl2016';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'dni' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'nombre' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telefono' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'plaza' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'dni' => 'Lorem ip',
            'nombre' => 'Lorem ipsum dolor sit amet',
            'telefono' => 'Lorem ipsum dolor sit amet',
            'plaza' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
