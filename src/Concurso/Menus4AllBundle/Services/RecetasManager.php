<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Receta;
use Concurso\Menus4AllBundle\Entity\Ingrediente;

class RecetasManager {

    protected $em, $validator, $translator;

    public function __construct($em, $validator, $translator) {
        $this->em = $em;
        $this->validator = $validator;
        $this->translator = $translator;
    }

    public function createReceta($json) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);

//            foreach ($data['ingredientes'] as $datos_ingr) {
//                $ingrediente = $this->crearIngrediente($datos_ingr['nombre']);
//                $receta->addIngredientes($ingrediente, $datos_ingr['cantidad']);
//            }
            $errors = $this->validator->validate($receta);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $this->translator->transChoice($error->getMessageTemplate(), 1 , $error->getMessageParameters(), 'validators');
                }
                return $resultado;
            }
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $receta->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $mapexc->getMessage();
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $flushexc->getMessage();
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $exc->getMessage();
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
            $listaReceta['ingredientes'] = $receta->getIngredientesReceta();
            $resultado['listaReceta'] = $listaReceta;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readRecetaCollection() {
        try {
            $recetas = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->findAll();
//            $ingredientes = $recetas[1]->getIngredientesReceta();
//            print_r($ingredientes); exit;
            $listaRecetas = array();
            foreach ($recetas as $i => $receta) {
                $listaRecetas[$i]['id'] = $receta->getId();
                $listaRecetas[$i]['nombre'] = $receta->getNombre();
                $listaRecetas[$i]['n_personas'] = $receta->getNPersonas();
                $listaRecetas[$i]['descripcion'] = $receta->getDescripcion();
                $ingredientes = $receta->getIngredientesReceta();
                foreach ($ingredientes as $j => $ingrediente) {
                    $listaRecetas[$i]['ingredientes'][$j]['nombre'] = $ingrediente->getIngrediente()->getNombre();
                    $listaRecetas[$i]['ingredientes'][$j]['cantidad'] = $ingrediente->getCantidad();
                }
            }
            $resultado['listaRecetas'] = $listaRecetas;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $mapexc->getMessage();
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $exc->getMessage();
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

    private function crearIngrediente($nombre) {
        $ingrediente = $this->em->getRepository('ConcursoMenus4AllBundle:Ingrediente')->findOneByNombre($nombre);
        if (is_null($ingrediente)) {
            $ingrediente = new Ingrediente();
            $ingrediente->setNombre($nombre);
            $ingrediente->setCalorias(200);
            $ingrediente->setGrasas(25);
            $ingrediente->setCarbohidratos(25);
            $ingrediente->setProteinas(25);
            $this->em->persist($ingrediente);
        }
        return $ingrediente;
    }

}
