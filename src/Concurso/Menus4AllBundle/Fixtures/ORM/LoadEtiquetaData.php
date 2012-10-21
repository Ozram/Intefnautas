<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Etiqueta;

class LoadEtiquetaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $etiqueta1 = new Etiqueta();
        $etiqueta1->setTexto('php');
        $etiqueta1->setUsuario($this->getReference('alberto'));
        $this->addReference('e_php', $etiqueta1);
        
        $etiqueta2 = new Etiqueta();
        $etiqueta2->setTexto('circo');
        $etiqueta2->setUsuario($this->getReference('maximo'));
        $this->addReference('e_circo', $etiqueta2);
        
        $etiqueta3 = new Etiqueta();
        $etiqueta3->setTexto('php');
        $etiqueta3->setUsuario($this->getReference('maximo'));
        $this->addReference('e_php2', $etiqueta3);
        
        $etiqueta4 = new Etiqueta();
        $etiqueta4->setTexto('lol');
        $etiqueta4->setUsuario($this->getReference('maria'));
        $this->addReference('e_lol', $etiqueta4);

        $manager->persist($etiqueta1);
        $manager->persist($etiqueta2);
        $manager->persist($etiqueta3);
        $manager->persist($etiqueta4);
        
        $manager->flush();
     
    }

    public function getOrder() {
        return 3;
    }

}