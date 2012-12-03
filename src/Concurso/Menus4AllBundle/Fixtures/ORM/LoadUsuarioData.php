<?php

namespace Concurso\Menus4AllBundle\Fixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Concurso\Menus4AllBundle\Entity\Usuario;

class LoadUsuarioData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        // Usuarios
        $usuario1 = new Usuario();
        $usuario1->setNombre('Alberto');
        $usuario1->setApellidos('Einstein');
        $usuario1->setUsername('admin');
        $usuario1->setPassword('4rHrVuWGdtGRX4c8mSXI8ydjCtoLAvsFH0khYEjtCXQdfjtLXvLLl95RwddcXltQ');
        $usuario1->setEmail('alberto@mentornotas.es');
        $usuario1->setExpired(true);
        $usuario1->setEnabled(true);
        $usuario1->setConfirmationToken('');
        $usuario1->setRoles(array('ROLE_USER'));

        $manager->persist($usuario1);
        $this->addReference('alberto', $usuario1);

        $usuario2 = new Usuario();
        $usuario2->setNombre('Máximo');
        $usuario2->setApellidos('Planck');
        $usuario2->setUsername('maximo');
        $usuario2->setPassword('4rHrVuWGdtGRX4c8mSXI8ydjCtoLAvsFH0khYEjtCXQdfjtLXvLLl95RwddcXltQ');
        $usuario2->setEmail('maximo@mentornotas.es');
        $usuario2->setExpired(true);
        $usuario2->setEnabled(true);
        $usuario2->setConfirmationToken('');
        $usuario2->setRoles(array('ROLE_USER'));

        $manager->persist($usuario2);
        $this->addReference('maximo', $usuario2);

        $usuario3 = new Usuario();
        $usuario3->setNombre('María');
        $usuario3->setApellidos('Curie');
        $usuario3->setUsername('maria');
        $usuario3->setPassword('4rHrVuWGdtGRX4c8mSXI8ydjCtoLAvsFH0khYEjtCXQdfjtLXvLLl95RwddcXltQ');
        $usuario3->setEmail('maria@mentornotas.es');
        $usuario3->setExpired(true);
        $usuario3->setEnabled(true);
        $usuario3->setConfirmationToken('');
        $usuario3->setRoles(array('ROLE_USER'));

        $manager->persist($usuario3);
        $this->addReference('maria', $usuario3);

        $usuario4 = new Usuario();
        $usuario4->setNombre('Isaac');
        $usuario4->setApellidos('Newton');
        $usuario4->setUsername('isaac');
        $usuario4->setPassword('4rHrVuWGdtGRX4c8mSXI8ydjCtoLAvsFH0khYEjtCXQdfjtLXvLLl95RwddcXltQ');
        $usuario4->setEmail('isaac@kk.es');
        $usuario4->setExpired(true);
        $usuario4->setEnabled(true);
        $usuario4->setConfirmationToken('');
        $usuario4->setRoles(array('ROLE_USER'));

        $manager->persist($usuario4);
        $this->addReference('isaac', $usuario4);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}