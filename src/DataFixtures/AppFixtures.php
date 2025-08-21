<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipPart;
use App\Entity\StarshipStatusEnum;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $starship = new Starship();
        $starship->setName('USS Taco Tuesday');
        $starship->setClass('Tex-Mex');
        $starship->checkIn();
        $starship->setCaptain('James T. Nacho');
        $manager->persist($starship);

        $part = new StarshipPart();
        $part->setName('spoiler');
        $part->setNotes('There\'s no air drag in space, but it looks cool.');
        $part->setPrice(500);
        $manager->persist($part);
        $part->setStarship($starship);
        $manager->flush();

        StarshipFactory::createMany(20);
    }
}
