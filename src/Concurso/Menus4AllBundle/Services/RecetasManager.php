<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Receta;

class RecetasManager {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function createReceta($json) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
        } catch (\Exception $exc) {
            $statusCode = 500;
        }
        return $statusCode;
    }

    public function readReceta($id) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
        } catch (\Exception $exc) {
            $statusCode = 500;
        }
        return $statusCode;
    }

    public function readRecetaCollection($data) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
        } catch (\Exception $exc) {
            $statusCode = 500;
        }
        return $statusCode;
    }

    public function updateReceta($id, $data) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
        } catch (\Exception $exc) {
            $statusCode = 500;
        }
        return $statusCode;
    }

    public function deleteReceta($id) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
        } catch (\Exception $exc) {
            $statusCode = 500;
        }
        return $statusCode;
    }

}