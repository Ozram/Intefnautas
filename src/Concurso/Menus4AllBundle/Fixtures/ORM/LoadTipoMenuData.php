<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\TipoMenu;

class LoadTipoMenuData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $tipoMenu1 = new TipoMenu();
        $tipoMenu1->setNombre('desayuno');
        $this->addReference('desayuno', $tipoMenu1);

        $tipoMenu2 = new TipoMenu();
        $tipoMenu2->setNombre('comida');
        $this->addReference('comida', $tipoMenu2);

        $tipoMenu3 = new TipoMenu();
        $tipoMenu3->setNombre('merienda');
        $this->addReference('merienda', $tipoMenu3);

        $tipoMenu4 = new TipoMenu();
        $tipoMenu4->setNombre('cena');
        $this->addReference('cena', $tipoMenu4);

        $manager->persist($tipoMenu1);
        $manager->persist($tipoMenu2);
        $manager->persist($tipoMenu3);
        $manager->persist($tipoMenu4);

        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }

}