<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity.
 */
class Task extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'start' => true,
        'end' => true,
        'user_id' => true,
        'project_id' => true,
        'parent_task_id' => true,
        'user' => true,
        'project' => true,
        'task' => true,
    ];
}
