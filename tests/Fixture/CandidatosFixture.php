<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CandidatosFixture
 *
 */
class CandidatosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'dni' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'nombre' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'apellidos' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'direccion' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'expediente' => ['type' => 'string', 'length' => 9, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cea_id' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nacimiento' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'tipo' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'estudios' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telefono' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'clasificado_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'motivacion' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => 'Sin valorar', 'comment' => '', 'precision' => null, 'fixed' => null],
        'habitos' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => 'Sin valorar', 'comment' => '', 'precision' => null, 'fixed' => null],
        'habilidades' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => 'Sin valorar', 'comment' => '', 'precision' => null, 'fixed' => null],
        'especialidad' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => 'Sin valorar', 'comment' => '', 'precision' => null, 'fixed' => null],
        'dificultades' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'observaciones' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'dni' => ['type' => 'unique', 'columns' => ['dni'], 'length' => []],
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
            'dni' => 'Lorem ipsum d',
            'nombre' => 'Lorem ipsum dolor sit amet',
            'apellidos' => 'Lorem ipsum dolor sit amet',
            'direccion' => 'Lorem ipsum dolor sit amet',
            'expediente' => 'Lorem i',
            'cea_id' => 1,
            'nacimiento' => '2016-04-03',
            'tipo' => 'Lorem ipsum dolor sit amet',
            'estudios' => 'Lorem ipsum dolor sit amet',
            'telefono' => 'Lorem ipsum dolor sit amet',
            'clasificado_id' => 1,
            'motivacion' => 'Lorem ipsum dolor ',
            'habitos' => 'Lorem ipsum dolor ',
            'habilidades' => 'Lorem ipsum dolor ',
            'especialidad' => 'Lorem ipsum dolor sit amet',
            'dificultades' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
