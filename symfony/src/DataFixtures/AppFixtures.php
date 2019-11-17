<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Employee;
use App\Entity\SalaryRule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # taxes settings
        $country = new Country();
        $country->setName('Russia');
        $country->setCode('RU');
        $country->setTaxPercent(20 * 100);
        $manager->persist($country);

        # employees
        $employee = new Employee();
        $employee->setFirstName('Alice');
        $employee->setLastName('White');
        $employee->setBirthDate(new \DateTime('1993-05-14'));
        $employee->setChildren(2);
        $employee->setRentCar(false);
        $employee->setSalary(6000);
        $manager->persist($employee);

        $employee = new Employee();
        $employee->setFirstName('Bob');
        $employee->setLastName('Gray');
        $employee->setBirthDate(new \DateTime('1967-01-16'));
        $employee->setChildren(0);
        $employee->setRentCar(true);
        $employee->setSalary(4000);
        $manager->persist($employee);

        $employee = new Employee();
        $employee->setFirstName('Charlie');
        $employee->setLastName('Black');
        $employee->setBirthDate(new \DateTime('1983-02-25'));
        $employee->setChildren(3);
        $employee->setRentCar(true);
        $employee->setSalary(5000);
        $manager->persist($employee);

        # salary rules
        $rule = new SalaryRule();
        $rule->setTitle('If an employee older than 50 we want to add 7% to his salary');
        $rule->setExpression('employee.getAge() > 50');
        $rule->setType(SalaryRule::TYPE_INCREASE);
        $rule->setPercent(7 * 100);
        $rule->setSource(SalaryRule::SOURCE_SALARY);
        $manager->persist($rule);

        $rule = new SalaryRule();
        $rule->setTitle('If an employee has more than 2 kids we want to decrease his Tax by 2%');
        $rule->setExpression('employee.getChildren() > 2');
        $rule->setType(SalaryRule::TYPE_DECREASE);
        $rule->setPercent(2 * 100);
        $rule->setSource(SalaryRule::SOURCE_TAX);
        $manager->persist($rule);

        $rule = new SalaryRule();
        $rule->setTitle('If an employee wants to use a company car we need to deduct $500');
        $rule->setExpression('employee.getRentCar() == true');
        $rule->setType(SalaryRule::TYPE_DECREASE);
        $rule->setMoney(500 * 100);
        $rule->setSource(SalaryRule::SOURCE_SALARY);
        $manager->persist($rule);

        $manager->flush();
    }
}
