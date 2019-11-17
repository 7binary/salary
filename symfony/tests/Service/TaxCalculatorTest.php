<?php

namespace App\Tests\Service;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\Service\TaxCalculator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class TaxCalculatorTest extends TestCase
{
    use ContainerTrait;

    public function testCalculateTaxPercent()
    {
        $container = $this->getContainer();
        /** @var EntityManagerInterface $em */
        $em = $container->get('doctrine')->getManager();
        /** @var TaxCalculator $taxCalculator */
        $taxCalculator = $container->get(TaxCalculator::class);

        /** @var EmployeeRepository $repo */
        $repo = $em->getRepository(Employee::class);
        $employeeAlice = $repo->findOneByFirstName('Alice');
        $employeeBob = $repo->findOneByFirstName('Bob');
        $employeeCharlie = $repo->findOneByFirstName('Charlie');

        $taxAlice = $taxCalculator->calculateTaxPercent($employeeAlice);
        $taxBob = $taxCalculator->calculateTaxPercent($employeeBob);
        $taxCharlie = $taxCalculator->calculateTaxPercent($employeeCharlie);

        $this->assertEquals(20, $taxAlice);
        $this->assertEquals(20, $taxBob);
        $this->assertEquals(18, $taxCharlie);
    }
}
