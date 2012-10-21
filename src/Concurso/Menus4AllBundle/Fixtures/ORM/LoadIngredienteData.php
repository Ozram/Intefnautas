<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Ingrediente;

class LoadIngredienteData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {





        // Ingredientes
        $ingrediente1 = new Ingrediente();
        $ingrediente1->setNombre('Arroz');
        $ingrediente1->setCalorias('130');
        $ingrediente1->setCarbohidratos('28.73');
        $ingrediente1->setGrasas('0.19');
        $ingrediente1->setProteinas('2.36');

        $manager->persist($ingrediente1);
        $this->addReference('arroz', $ingrediente1);

        $ingrediente2 = new Ingrediente();
        $ingrediente2->setNombre('Maiz');
        $ingrediente2->setCalorias('130');
        $ingrediente2->setCarbohidratos('28.73');
        $ingrediente2->setGrasas('0.19');
        $ingrediente2->setProteinas('2.36');

        $manager->persist($ingrediente2);
        $this->addReference('maiz', $ingrediente2);

        $ingrediente3 = new Ingrediente();
        $ingrediente3->setNombre('Trigo');
        $ingrediente3->setCalorias('130');
        $ingrediente3->setCarbohidratos('28.73');
        $ingrediente3->setGrasas('0.19');
        $ingrediente3->setProteinas('2.36');

        $manager->persist($ingrediente3);
        $this->addReference('trigo', $ingrediente3);

        $ingrediente4 = new Ingrediente();
        $ingrediente4->setNombre('Avena');
        $ingrediente4->setCalorias('130');
        $ingrediente4->setCarbohidratos('28.73');
        $ingrediente4->setGrasas('0.19');
        $ingrediente4->setProteinas('2.36');

        $manager->persist($ingrediente4);
        $this->addReference('avena', $ingrediente4);

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}