<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\ListaCompra;

class LoadListaCompraData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $listaCompra1 = new ListaCompra();
        $listaCompra1->setNombre('Arroz con trigo');
        $listaCompra1->setUsuario($this->getReference('alberto'));
        $listaCompra1->addIngrediente($this->getReference('arroz'), 200);
        $listaCompra1->addIngrediente($this->getReference('trigo'), 200);

        $listaCompra2 = new ListaCompra();
        $listaCompra2->setNombre('Arroz con avena');
        $listaCompra2->setUsuario($this->getReference('maria'));
        $listaCompra2->addIngrediente($this->getReference('arroz'), 200);
        $listaCompra2->addIngrediente($this->getReference('avena'), 200);

        $listaCompra3 = new ListaCompra();
        $listaCompra3->setNombre('Arroz con maiz');
        $listaCompra3->setUsuario($this->getReference('isaac'));
        $listaCompra3->addIngrediente($this->getReference('arroz'), 200);
        $listaCompra3->addIngrediente($this->getReference('maiz'), 200);

        $manager->persist($listaCompra1);
        $manager->persist($listaCompra2);
        $manager->persist($listaCompra3);

        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }

}