<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\RecetaCompartida;

class RecetasCompartidasManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createRecetaCompartida($json, $idUsuario) {
        $data = json_decode($json, true);
        $recetaCompartida = new RecetaCompartida();
        try {
            $recetaCompartida->setEmisor($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($idUsuario));
            $recetaCompartida->setReceptor($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($data['usuario']));
            $recetaCompartida->setMensaje($data['mensaje']);
            $recetaCompartida->setVisitado(false);
            $recetaCompartida->setMenu($this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($data['menu']));
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readRecetaCompartidaCollection($idUsuario) {
        try {
            $recetasCompartidas = $this->em->getRepository('ConcursoMenus4AllBundle:RecetaCompartida')->findByIdReceptor($idUsuario);
            $listaRecetasCompartidas = array();
            foreach ($recetasCompartidas as $i => $recetaCompartida) {
                $listaRecetasCompartidas[$i]['id'] = $recetaCompartida->getId();
                $emisor = $recetaCompartida->getEmisor();
                $listaRecetasCompartidas[$i]['emisor'] = $emisor->getId();
                $menu = $recetaCompartida->getMenu();
                $listaRecetasCompartidas[$i]['menu'] = $menu->getId();
            }
            $resultado['listaRecetasCompartidas'] = $listaRecetasCompartidas;
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

    public function updateRecetaCompartida($id) {
        try {
            $recetaCompartida = $this->em->getRepository('ConcursoMenus4AllBundle:RecetaCompartida')->find($id);
            $recetaCompartida->setVisitado(true);

            $errors = $this->validator->validate($recetaCompartida);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($recetaCompartida);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $recetaCompartida->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function deleteRecetaCompartida($id) {
        try {
            $recetaCompartida = $this->em->getRepository('ConcursoMenus4AllBundle:RecetaCompartida')->find($id);
            $this->em->remove($recetaCompartida);
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
