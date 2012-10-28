<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\ValoracionMenu;

class ValoracionesMenuManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createValoracionMenu($json) {
        $data = json_decode($json, true);
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $valoracionMenu = new ValoracionMenu();
        try {
            $valoracionMenu->setMenu($data['idMenu']);
            $valoracionMenu->setIdUsuario($idUsuario);
            $valoracionMenu->setNombre($data['nombre']);
            $valoracionMenu->setPuntuacion($data['puntuacion']);
            $valoracionMenu->setComentario($data['comentario']);

            $errors = $this->validator->validate($valoracionMenu);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($valoracionMenu);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $valoracionMenu->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readValoracionMenu($id) {
        try {
            $valoracionMenu = $this->em->getRepository('ConcursoMenus4AllBundle:ValoracionMenu')->find($id);
            $listaValoracionMenu['id'] = $valoracionMenu->getId();
            $listaValoracionMenu['nombre'] = $valoracionMenu->getNombre();
            $listaValoracionMenu['puntuacion'] = $valoracionMenu->getPuntuacion();
            $listaValoracionMenu['idMenu'] = $valoracionMenu->getMenu();
            $listaValoracionMenu['idUsuario'] = $valoracionMenu->getUsuario();
            $resultado['listaMenu'] = $listaValoracionMenu;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readValoracionMenuCollection($json) {
        $data = json_decode($json, true);
        try {
            $valoracionesMenu = new \Concurso\Menus4AllBundle\Entity\ValoracionMenuRepository();
            $valoracionesMenu = $this->em->getRepository('ConcursoMenus4AllBundle:ValoracionMenu')->findByIdMenu($data['idMenu']);
            $listaValoracionesMenu = array();
            foreach ($valoracionesMenu as $i => $valoracionMenu) {
                $listaValoracionesMenu[$i]['id'] = $valoracionMenu->getId();
                $listaValoracionesMenu[$i]['nombre'] = $valoracionMenu->getNombre();
                $listaValoracionesMenu[$i]['puntuacion'] = $valoracionMenu->getPuntuacion();
                $listaValoracionesMenu[$i]['idMenu'] = $valoracionMenu->getMenu();
                $listaValoracionesMenu[$i]['idUsuario'] = $valoracionMenu->getUsuario();
            }
            $resultado['listaMenus'] = $listaValoracionesMenu;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function updateValoracionMenu($id, $json) {
        $data = json_decode($json, true);
        try {
            $valoracionMenu = $this->em->getRepository('ConcursoMenus4AllBundle:ValoracionMenu')->find($id);

            $valoracionMenu->setNombre($data['nombre']);
            $valoracionMenu->getPuntuacion($data['puntuacion']);
            $valoracionMenu->getMenu($data['idMenu']);
            $valoracionMenu->getUsuario($data['idUsuario']);
            
            $errors = $this->validator->validate($valoracionMenu);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($valoracionMenu);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $valoracionMenu->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

}