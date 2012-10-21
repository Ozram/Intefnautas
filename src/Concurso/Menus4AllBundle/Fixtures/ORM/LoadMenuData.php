<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Menu;

class LoadMenuData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $menu1 = new Menu();
        $menu1->setNombre('Arroz con trigo');
        $menu1->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $menu1->setTipoMenu($this->getReference('desayuno'));
        $menu1->setValoracion($this->getReference('valoracion-registrado'));
        $menu1->setUsuario($this->getReference('alberto'));
        $menu1->addReceta($this->getReference('arroz_avena'));
        $menu1->addReceta($this->getReference('arroz_trigo'));

        $menu2 = new Menu();
        $menu2->setNombre('Arroz con avena');
        $menu2->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $menu2->setTipoMenu($this->getReference('comida'));
        $menu2->setValoracion($this->getReference('valoracion-premium'));
        $menu2->setUsuario($this->getReference('maria'));
        $menu2->addReceta($this->getReference('arroz_maiz'));
        $menu2->addReceta($this->getReference('arroz_avena'));

        $menu3 = new Menu();
        $menu3->setNombre('Arroz con maiz');
        $menu3->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $menu3->setTipoMenu($this->getReference('cena'));
        $menu3->setValoracion($this->getReference('valoracion-admin'));
        $menu3->setUsuario($this->getReference('isaac'));
        $menu3->addReceta($this->getReference('arroz_trigo'));
        $menu3->addReceta($this->getReference('arroz_maiz'));

        $manager->persist($menu1);
        $manager->persist($menu2);
        $manager->persist($menu3);

        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }

}