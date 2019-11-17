<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalaryRuleRepository")
 */
class SalaryRule
{
    const TYPE_INCREASE = 'increase';
    const TYPE_DECREASE = 'decrease';

    const SOURCE_SALARY = 'salary';
    const SOURCE_TAX = 'tax';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $expression;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $money;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $percent;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isIncrease(): bool
    {
        return $this->type === self::TYPE_INCREASE;
    }

    public function isDecrease(): bool
    {
        return $this->type === self::TYPE_DECREASE;
    }

    public function getRealMoney(): ?float
    {
        return $this->money / 100;
    }

    public function getMoney(): ?int
    {
        return $this->money;
    }

    public function getMoneySigned(): ?int
    {
        return $this->isIncrease() ? $this->money : (-1 * $this->money);
    }

    public function getRealMoneySigned(): ?int
    {
        $money = $this->isIncrease() ? $this->money : (-1 * $this->money);
        return $money / 100;
    }

    public function setMoney(?int $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function getRealPercent(): ?float
    {
        return $this->percent / 100;
    }

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function getPercentSigned()
    {
        return $this->isIncrease() ? $this->percent : (-1 * $this->percent);
    }

    public function getRealPercentSigned()
    {
        $percent = $this->isIncrease() ? $this->percent : (-1 * $this->percent);
        return $percent / 100;
    }

    public function setPercent(?int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
