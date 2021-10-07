<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use App\Model\Entity\Group;
use App\Model\Entity\User;
use Cake\Cache\Cache;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * InvalidateUsers behavior
 */
class InvalidateUsersBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function afterSave(EventInterface $event, EntityInterface $entity, \ArrayObject $options): void
    {
        $this->invalidate($entity);
    }

    public function afterDelete(EventInterface $event, EntityInterface $entity, \ArrayObject $options): void
    {
        $this->invalidate($entity);
    }

    protected function invalidate(EntityInterface $entity): void
    {
        if ($entity instanceof User) {
            Cache::delete('user_' . $entity->get('id'), 'users');
        }
        if ($entity instanceof Group) {
            $idsOriginal = collection((array)$entity->getOriginal('users'))->extract('id')->toArray();
            $idsCurrent = collection((array)$entity->get('users'))->extract('id')->toArray();
            $userIds = array_unique(array_merge($idsOriginal, $idsCurrent));
            // careful with deleteMany, it will stop if any key is not valid > Cache::deleteMany($cacheKeys->toArray(), 'users');
            foreach ($userIds as $userId) {
                Cache::delete('user_' . $userId, 'users');
            }
        }
    }
}
