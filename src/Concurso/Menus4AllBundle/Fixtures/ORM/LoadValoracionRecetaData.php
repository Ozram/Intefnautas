<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\ValoracionReceta;

class LoadValoracionRecetaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        // ValoracionRecetas
        $valoracionrec1 = new ValoracionReceta();
        $valoracionrec1->setPuntuacion(4);
        $valoracionrec1->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionrec1->setReceta($this->getReference('arroz_avena'));
        $manager->persist($valoracionrec1);

        $valoracionrec2 = new ValoracionReceta();
        $valoracionrec2->setPuntuacion(3);
        $valoracionrec2->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionrec2->setReceta($this->getReference('arroz_trigo'));
        $manager->persist($valoracionrec2);

        $valoracionrec3 = new ValoracionReceta();
        $valoracionrec3->setPuntuacion(2);
        $valoracionrec3->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionrec3->setReceta($this->getReference('arroz_maiz'));
        $manager->persist($valoracionrec3);


        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }

}