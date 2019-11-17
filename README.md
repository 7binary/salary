# Technical Challenge
Please, keep in mind OOP, software design patterns, code architecture, tests and accuracy in
implementation during developing.
Here you need to build an application which can calculate the salary of employees.
We need to have an expandable system of bonuses or deductions.
### Explanation
- Country Tax for salaries is 20%
- If an employee older than 50 we want to add 7% to his salary
- If an employee has more than 2 kids we want to decrease his Tax by 2%
- If an employee wants to use a company car we need to deduct $500
### Situation
- Alice is 26 years old, she has 2 kids and her salary is $6000
- Bob is 52, he is using a company car and his salary is $4000
- Charlie is 36, he has 3 kids, company car and his salary is $5000

CODE
-----------------------------------------------------
> Core logic of calculations are inside services.
- TaxCalculator: /symfony/src/Service/TaxCalculator.php
- SalaryCalculator: /symfony/src/Service/SalaryCalculator.php

> Tests to check calculators services.
- TaxCalculatorTest: /symfony/tests/Service/TaxCalculatorTest.php
- SalaryCalculatorTest: /symfony/tests/Service/SalaryCalculator.php

## PREPARE FOR DOCKER COMPOSE
> edit file "/etc/hosts" to include
```
127.0.0.1 symfony.localhost
``` 
> clone repository
```
git clone https://github.com/7binary/salary.git
cd salary
```
> run docker-compose
```
docker-compose up
```

## PREPARE SYMFONY PROJECT
```
cd symfony
composer install --prefer-dist
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```

## RUN TESTS FOR TAX/SALARY
```
./bin/phpunit
```
