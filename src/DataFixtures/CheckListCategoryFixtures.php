<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CheckListCategory;
use App\Entity\CheckListPodcategory;

class CheckListCategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $this->loadMainCategories($manager);

    }


    private function loadMainCategories($manager): void
    {

        foreach($this->getMainCategoriesData() as $name)
        {
            $categoryOfTask = new CheckListCategory();
            $categoryOfTask->setName($name);
            $manager->persist($categoryOfTask);
        }
        

        $manager->flush();
    }


    private function getMainCategoriesData()
    {
        return [
            'Etap planowania',
            'Sala weselna',
            'Fotograf',
            'Kamerzysta',
            'Oprawa muzyczna wesela',
            'Goście',
            'Podziękowania',
            'Panna Młoda',
            'Pan Młody',
            'Papeteria',
            'Obrączki',
            'Pierwszy taniec',
            'Kościół, USC',
            'Przygotowania',
            'Transport i nocleg',
            'Kwiaty i dekoracje',
            'Dodatkowo',

        ];
    }


}
