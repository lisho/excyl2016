<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diagnostico Entity.
 *
 * @property int $id
 * @property string $motivacion
 * @property string $habitos
 * @property string $habilidades
 * @property string $especialidad
 * @property string $dificultades
 * @property string $observaciones
 * @property int $candidatos_id
 * @property \App\Model\Entity\Candidato $candidato
 */
class Diagnostico extends Entity
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
