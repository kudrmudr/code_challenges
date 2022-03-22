<?php


namespace Auto1;

use PHPUnit\Framework\TestCase;

interface HeroInterface
{
    public function getAttack(): int;

    public function getDefence(): int;

    public function getHealthPoints(): int;

    public function setHealthPoints(int $healthPoints);
}

//@TODO we need to implement tests for this class in separate unit test file.
//I assume that it is out of scope of the task
class DamageCalculator
{
    public const DAMAGE_RAND_FACTOR = 0.2;

    public function calculateDamage(HeroInterface $attacker, HeroInterface $defender): int
    {
        $damage = 0;

        if ($attacker->getAttack() > $defender->getDefence()) {
            $baseDamage = $attacker->getAttack() - $defender->getDefence();

            $factor = $baseDamage * self::DAMAGE_RAND_FACTOR;

            $minDamage = $baseDamage - $factor;
            $maxDamage = $baseDamage + $factor;

            //A mistake here. if strict_types is ON, $minDamage and $maxDamage are float, not integer
            $damage = mt_rand($minDamage, $maxDamage);
        }

        return $damage;
    }
}

class FightService
{
    //we inject DamageCalculator via DI because:
    // - maybe in future we will have more complicated and depend on another services implementation of the calculator
    // - and it is easy to write unit test for it by mocking
    public function __construct(
        private DamageCalculator $damageCalculator
    ) {
    }

    public function fight(HeroInterface $attacker, HeroInterface $defender): void
    {
        $damage = $this->damageCalculator->calculateDamage($attacker, $defender);
        $defender->setHealthPoints($defender->getHealthPoints() - $damage);
    }
}

class FightServiceTest extends TestCase {

    private DamageCalculator $damageCalculator;

    public function setUp(): void
    {
        $this->damageCalculator = $this->createMock(DamageCalculator::class);
    }

    public function testFight(): void
    {
        $damageValue = random_int(1, 1000);;
        $defenderHealthPoints = random_int($damageValue, 1000);
        $expectedDefenderHealthPoints = $defenderHealthPoints - $damageValue;

        $expectedAttacker = $this->createMock(HeroInterface::class);

        $expectedDefender = $this->createMock(HeroInterface::class);
        $expectedDefender
            ->method('getHealthPoints')->willReturn($defenderHealthPoints);
        $expectedDefender
            ->expects($this->once())->method('setHealthPoints')
            ->with($this->equalTo($expectedDefenderHealthPoints));

        $this->damageCalculator
            ->expects($this->once())
            ->method('calculateDamage')
            ->with($expectedAttacker, $expectedDefender)
            ->willReturn($damageValue);

        $fightService = new FightService($this->damageCalculator);
        $fightService->fight($expectedAttacker, $expectedDefender);
    }
}