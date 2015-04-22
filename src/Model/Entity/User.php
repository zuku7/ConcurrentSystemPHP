<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
// Make all fields mass assignable for now.
protected $_accessible = ['*' => true];

protected function _setPassword($password) {
      $hasher = new  \Cake\Auth\DefaultPasswordHasher();
    return $hasher->hash($password);
}

}
	