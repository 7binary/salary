<?php

namespace App\Repository;

use App\Entity\SalaryRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SalaryRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalaryRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalaryRule[]    findAll()
 * @method SalaryRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalaryRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalaryRule::class);
    }

    public function findTaxRules()
    {
        return $this->findBy(['source' => SalaryRule::SOURCE_TAX]);
    }

    public function findSalaryRules()
    {
        return $this->findBy(['source' => SalaryRule::SOURCE_SALARY]);
    }
}
