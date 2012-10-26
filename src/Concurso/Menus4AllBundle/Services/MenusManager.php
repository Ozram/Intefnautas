<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Menu;

class MenusManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createMenu($json) {
        $data = json_decode($json, true);
        $menu = new Menu();
        try {
            $menu->setNombre($data['nombre']);
            $menu->setDescripcion($data['descripcion']);
            $errors = $this->validator->validate($menu);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($menu);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $menu->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readMenu($id) {
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $listaMenu['id'] = $menu->getId();
            $listaMenu['nombre'] = $menu->getNombre();
            $listaMenu['descripcion'] = $menu->getDescripcion();
            $resultado['listaMenu'] = $listaMenu;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readMenuCollection() {
        try {
            $menus = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->findAll();
            $listaMenus = array();
            foreach ($menus as $i => $menu) {
                $listaMenus[$i]['id'] = $menu->getId();
                $listaMenus[$i]['nombre'] = $menu->getNombre();
                $listaMenus[$i]['descripcion'] = $menu->getDescripcion();
            }
            $resultado['listaMenus'] = $listaMenus;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function updateMenu($id, $json) {
        $data = json_decode($json, true);
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $menu->setNombre($data['nombre']);
            $menu->setDescripcion($data['descripcion']);
            $errors = $this->validator->validate($menu);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($menu);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $menu->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function deleteMenu($id) {
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $this->em->remove($menu);
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