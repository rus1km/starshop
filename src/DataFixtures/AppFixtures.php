<?php

namespace App\DataFixtures;

use App\Factory\DroidFactory;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StarshipFactory::createMany(20);
        StarshipPartFactory::createMany(100);
        DroidFactory::createMany(100);
    }
}
