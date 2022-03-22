<?php

namespace Auto1;

//I assume that we will have a lot of car details where painting is not important (like engine, transmission and etc)
//and I assume that for Paintable details in future we will have extra methods like getColor and etc which does not make
//sense for engine, transmission and others.
//So my suggestion is to have separate interface for Paintable details for future

interface BreakableInterface
{
    public function isBroken(): bool;
}

interface PaintableInterface
{
    public function isPaintingDamaged(): bool;
}

abstract class CarDetail implements BreakableInterface
{
    protected bool $isBroken;

    public function __construct(bool $isBroken)
    {
        $this->isBroken = $isBroken;
    }

    public function isBroken(): bool
    {
        return $this->isBroken;
    }
}

abstract class CarPaintedDetail extends CarDetail implements PaintableInterface
{
    protected bool $isPaintingDamaged;

    public function __construct(bool $isBroken, bool $isPaintingDamaged)
    {
        parent::__construct($isBroken);
        $this->isPaintingDamaged = $isPaintingDamaged;
    }

    public function isPaintingDamaged(): bool
    {
        return $this->isPaintingDamaged;
    }
}


class Door extends CarPaintedDetail
{
}

class Tyre extends CarDetail
{
}

class Car
{
    /** @var CarDetail[] */
    private array $details;

    /** @param CarDetail[] $details */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function isBroken(): bool
    {
        foreach ($this->details as $detail) {

            if ($detail instanceof BreakableInterface && $detail->isBroken()) {
                return true;
            }
        }

        return false;
    }

    public function isPaintingDamaged(): bool
    {
        foreach ($this->details as $detail) {

            if ($detail instanceof PaintableInterface && $detail->isPaintingDamaged()) {
                return true;
            }
        }

        return false;
    }
}

$car = new Car(
    [
        new Door(false, true),
        new Tyre(false)
    ]
);

var_dump($car->isBroken(), $car->isPaintingDamaged());