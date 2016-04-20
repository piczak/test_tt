<?php


namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;


/**
 * @author Damian Wróblewski
 */
class UserRepository extends EntityRepository
{
    public function getListQueryBuilder(User $filter)
    {
        $qb = $this->createQueryBuilder('o');
        foreach (['email', 'firstName', 'lastName'] as $field) {
            $getter = 'get' . ucfirst($field);
            if ($filter->$getter()) {
                // @todo escape for like
                $qb->andWhere($qb->expr()->like('o.' . $field, ':' . $field))->setParameter($field, '%' . $filter->$getter() . '%');
            }
        }
        if ($filter->getRole()) {
            $qb
                ->andWhere($qb->expr()->like('o.roles', ':role'))
                ->setParameter('role', '%"' . $filter->getRole() . '"%');
        }
        return $qb;
    }

    /**
     * @param array|string[] $roles
     * @return array|User[]
     */
    public function findByRoles($roles)
    {
        $qb = $this->createQueryBuilder('u');
        $i = 0;
        foreach ($roles as $role) {
            $qb->orWhere('u.roles like :role' . $i)->setParameter('role' . $i, '%' . $role . '%');
            $i++;
        }
        return $qb->getQuery()->getResult();
    }
}
