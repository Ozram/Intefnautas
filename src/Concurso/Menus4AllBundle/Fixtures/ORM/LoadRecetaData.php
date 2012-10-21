<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Receta;

class LoadRecetaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $receta1 = new Receta();
        $receta1->setNombre('Arroz con trigo');
        $receta1->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $receta1->setNPersonas(2);
        $receta1->setValoracion('valoracion-registrado');
        $receta1->setUsuario($this->getReference('alberto'));
        $receta1->addIngrediente($this->getReference('arroz'));
        $receta1->addIngrediente($this->getReference('trigo'));
        
        $this->addReference('arroz_trigo', $receta1);

        $receta2 = new Receta();
        $receta2->setNombre('Arroz con avena');
        $receta2->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $receta2->setNPersonas(2);
        $receta2->setValoracion('valoracion-premium');
        $receta2->setUsuario($this->getReference('maria'));
        $receta2->addIngrediente($this->getReference('arroz'));
        $receta2->addIngrediente($this->getReference('avena'));
        
        $this->addReference('arroz_avena', $receta2);

        $receta3 = new Receta();
        $receta3->setNombre('Arroz con maiz');
        $receta3->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $receta3->setNPersonas(2);
        $receta3->setValoracion('valoracion-admin');
        $receta3->setUsuario($this->getReference('isaac'));
        $receta3->addIngrediente($this->getReference('arroz'));
        $receta3->addIngrediente($this->getReference('maiz'));
        
        $this->addReference('arroz_maiz', $receta3);

        $manager->persist($receta1);
        $manager->persist($receta2);
        $manager->persist($receta3);

        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }

}