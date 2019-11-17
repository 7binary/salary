<?php

namespace App\Tests\Service;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\Service\SalaryCalculator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class SalaryCalculatorTest extends TestCase
{
    use ContainerTrait;

    public function testCalculateSalary()
    {
        $container = $this->getContainer();
        /** @var EntityManagerInterface $em */
        $em = $container->get('doctrine')->getManager();
        /** @var SalaryCalculator $taxCalculator */
        $salaryCalculator = $container->get(SalaryCalculator::class);

        /** @var EmployeeRepository $repo */
        $repo = $em->getRepository(Employee::class);
        $employeeAlice = $repo->findOneByFirstName('Alice');
        $employeeBob = $repo->findOneByFirstName('Bob');
        $employeeCharlie = $repo->findOneByFirstName('Charlie');

        $salaryAlice = $salaryCalculator->calculateSalary($employeeAlice);
        $salaryBob = $salaryCalculator->calculateSalary($employeeBob);
        $salaryCharlie = $salaryCalculator->calculateSalary($employeeCharlie);

        $this->assertEquals(4800, $salaryAlice);
        $this->assertEquals(3024, $salaryBob);
        $this->assertEquals(3690, $salaryCharlie);
    }
}
