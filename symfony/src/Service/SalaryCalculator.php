<?php

namespace App\Service;

use App\Entity\SalaryRule;
use App\Interfaces\SalaryRulesInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class SalaryCalculator
{
    private $em;
    private $taxCalculator;

    public function __construct(EntityManagerInterface $em, TaxCalculator $taxCalculator)
    {
        $this->em = $em;
        $this->taxCalculator = $taxCalculator;
    }

    public function calculateSalary(SalaryRulesInterface $employee): float
    {
        $el = new ExpressionLanguage();
        $baseSalary = $salary = $employee->getSalary();
        $taxPercent = $this->taxCalculator->calculateTaxPercent($employee);

        /** @var SalaryRule[] $rules */
        $rules = $this->em->getRepository(SalaryRule::class)->findSalaryRules();

        if (count($rules)) {
            foreach ($rules as $rule) {
                if ($el->evaluate($rule->getExpression(), compact('employee'))) {
                    if ($percent = $rule->getRealPercentSigned()) {
                        $salary += $baseSalary * $percent / 100;
                    }
                    elseif ($money = $rule->getRealMoneySigned()) {
                        $salary += $money;
                    }
                }
            }
        }

        if ($taxPercent > 0) {
            $salary -= $salary * $taxPercent / 100;
        }

        return $salary;
    }
}
