<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidato Entity.
 *
 * @property int $id
 * @property string $dni
 * @property string $nombre
 * @property string $apellidos
 * @property string $direccion
 * @property string $expediente
 * @property int $cea_id
 * @property \App\Model\Entity\Cea $cea
 * @property \Cake\I18n\Time $nacimiento
 * @property string $tipo
 * @property string $estudios
 * @property string $telefono
 * @property int $clasificado_id
 * @property \App\Model\Entity\Clasificado $clasificado
 * @property string $motivacion
 * @property string $habitos
 * @property string $habilidades
 * @property string $especialidad
 * @property string $dificultades
 * @property string $observaciones
 */
class Candidato extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
