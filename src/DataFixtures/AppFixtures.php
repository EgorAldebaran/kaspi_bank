<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MSFT;

class AppFixtures extends Fixture
{
    public const FILE = 'public/MSFT.csv';
    
    public function load(ObjectManager $manager): void
    {
        $handle = fopen(self::FILE, 'r');
        fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== false) {
            $orcl = new MSFT;
            $orcl->setDate(new \DateTime($data[0]));
            $orcl->setOpenPrice($data[1]);
            $orcl->setHighPrice($data[2]);
            $orcl->setLowPrice($data[3]);
            $orcl->setClosePrice($data[4]);
            $orcl->setVolume($data[5]);
            $orcl->setAdjusted($data[6]);

            $manager->persist($orcl);
        }

        $manager->flush();
    }
}
