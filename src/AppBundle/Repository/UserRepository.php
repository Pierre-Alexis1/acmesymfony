<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class UserRepository extends EntityRepository
{
    /**
     * Uniquement les utilisateurs qui ont au moins un numéro de téléphone portable
     *
     * @return User[]
     */
    public function findAllHavingPhoneNumberStartingWith06()
    {
        $qb = $this->createQueryBuilder('user')
            ->addSelect('phoneNumber')
            ->innerJoin('user.phoneNumbers', 'phoneNumber', Join::WITH, 'phoneNumber.number LIKE :phoneStart')
            ->setParameter('phoneStart', '06%')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * Tous les utilisateurs, mais ne récupère pas les numéros de téléphone qui ne sont pas portables
     *
     * @return User[]
     */
    public function findAllWithPhoneNumberStartingWith06Only()
    {
        $qb = $this->createQueryBuilder('user')
            ->addSelect('phoneNumber')
            ->leftJoin('user.phoneNumbers', 'phoneNumber', Join::WITH, 'phoneNumber.number LIKE :phoneStart')
            ->setParameter('phoneStart', '06%')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @return User[]
     */
    public function findAllWithCompositeFirstName()
    {
        $query = $this->_em->createQuery('
            SELECT      user
            FROM        AppBundle:User user
            WHERE       user.firstName LIKE :compositePattern
        ');

        $query->setParameter('compositePattern', '%-%');

        return $query->getResult();
    }

    /**
     * @param int $maxAge
     *
     * @return User[]
     */
    public function findAllWithCompositeNameOlderThan($maxAge)
    {
        $qb = $this->createQueryBuilder('user');

        $qb->where($qb->expr()->andX(
            $qb->expr()->orX(
                $qb->expr()->like('user.firstName', ':compositePattern'),
                $qb->expr()->like('user.lastName', ':compositePattern')
            ),
            $qb->expr()->gt('user.age', ':maxAge')
        ))
            ->setParameter('maxAge', $maxAge)
            ->setParameter('compositePattern', '%-%')
        ;

        return $qb->getQuery()->getResult();
    }
}
