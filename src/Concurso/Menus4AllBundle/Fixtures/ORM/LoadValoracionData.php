<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Valoracion;

class LoadValoracionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        // Valoracions
        $valoracion1 = new Valoracion();
        $valoracion1->setPuntuacion(4);
        $valoracion1->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        
        $this->addReference('valoracion-registrado', $valoracion1);
        $manager->persist($valoracion1);

        $valoracion2 = new Valoracion();
        $valoracion2->setPuntuacion(3);
        $valoracion2->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

        $this->addReference('valoracion-premium', $valoracion2);
        $manager->persist($valoracion2);

        $valoracion3 = new Valoracion();
        $valoracion3->setPuntuacion(2);
        $valoracion3->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

        $this->addReference('valoracion-admin', $valoracion3);
        $manager->persist($valoracion3);


        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}