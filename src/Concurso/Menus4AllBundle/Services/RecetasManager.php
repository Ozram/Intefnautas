<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Receta;

class RecetasManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createReceta($json) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $errors = $this->validator->validate($receta);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach($errors as $error){
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $receta->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
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