<?php

namespace App\Interfaces;

interface SalaryRulesInterface
{
    public function getChildren(): ?int;

    public function getRentCar(): ?bool;

    public function getAge(): ?int;

    public function getSalary(): ?int;
}
