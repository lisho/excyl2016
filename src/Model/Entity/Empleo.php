<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empleo Entity.
 *
 * @property int $id
 * @property string $dni
 * @property string $e1
 * @property string $e2
 * @property string $e3
 * @property string $e4
 * @property string $e5
 * @property string $e6
 */
class Empleo extends Entity
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
