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
                foreach ($errors as $error) {
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
        try {
            $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($id);
            $listaReceta['id'] = $receta->getId();
            $listaReceta['nombre'] = $receta->getNombre();
            $listaReceta['n_personas'] = $receta->getNPersonas();
            $listaReceta['descripcion'] = $receta->getDescripcion();
            $resultado['listaReceta'] = $listaReceta;
            $resultado['statusCode']  = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode']  = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode']  = 500;
        }
        return $resultado;
    }

    public function readRecetaCollection() {
        try {
            $recetas = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->findAll();
            $listaRecetas = array();
            foreach ($recetas as $i => $receta) {
                $listaRecetas[$i]['id'] = $receta->getId();
                $listaRecetas[$i]['nombre'] = $receta->getNombre();
                $listaRecetas[$i]['n_personas'] = $receta->getNPersonas();
                $listaRecetas[$i]['descripcion'] = $receta->getDescripcion();
            }
            $resultado['listaRecetas'] = $listaRecetas;
            $resultado['statusCode']  = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode']  = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode']  = 500;
        }
        return $resultado;
    }

    public function updateReceta($id, $json) {
        $data = json_decode($json, true);
        try {
            $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($id);
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $errors = $this->validator->validate($receta);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
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

    public function deleteReceta($id) {
        try {
            $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($id);
            $this->em->remove($receta);
            $this->em->flush();
            $resultado['id'] = $id;
            $resultado['statusCode'] = 200;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

}