<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\ValoracionMenu;

class LoadValoracionMenuData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        // ValoracionMenus
        $valoracionmenu1 = new ValoracionMenu();
        $valoracionmenu1->setPuntuacion(4);
        $valoracionmenu1->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionmenu1->setMenu($this->getReference('arroz_trigo_maiz'));
        $manager->persist($valoracionmenu1);

        $valoracionmenu2 = new ValoracionMenu();
        $valoracionmenu2->setPuntuacion(3);
        $valoracionmenu2->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionmenu2->setMenu($this->getReference('arroz_avena_maiz'));
        $manager->persist($valoracionmenu2);

        $valoracionmenu3 = new ValoracionMenu();
        $valoracionmenu3->setPuntuacion(2);
        $valoracionmenu3->setComentario('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $valoracionmenu3->setMenu($this->getReference('arroz_avena_trigo'));
        $manager->persist($valoracionmenu3);


        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }

}