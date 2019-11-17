<?php

namespace App\Service;

use App\Entity\Country;
use App\Entity\SalaryRule;
use App\Interfaces\SalaryRulesInterface;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class TaxCalculator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function calculateTaxPercent(SalaryRulesInterface $employee): float
    {
        $el = new ExpressionLanguage();
        /** @var Country $country */
        $country = $this->em->getRepository(Country::class)->getDefaultCountry();
        $taxPersent = $country->getTaxPercent();

        /** @var SalaryRule[] $rules */
        $rules = $this->em->getRepository(SalaryRule::class)->findTaxRules();

        if (count($rules)) {
            foreach ($rules as $rule) {
                if ($el->evaluate($rule->getExpression(), compact('employee'))) {
                    $taxPersent += $rule->getPercentSigned();
                }
            }
        }

        if ($taxPersent < 0) {
            return 0;
        }

        return $taxPersent / 100;
    }
}
