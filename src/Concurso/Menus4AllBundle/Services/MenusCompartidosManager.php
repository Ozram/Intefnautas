<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\MenuCompartido;

class MenusCompartidosManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createMenuCompartido($json, $idUsuario) {
        $data = json_decode($json, true);
        $menuCompartido = new MenuCompartido();
        try {
            $menuCompartido->setEmisor($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($idUsuario));
            $menuCompartido->setReceptor($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($data['usuario']));
            $menuCompartido->setMensaje($data['mensaje']);
            $menuCompartido->setVisitado(false);
            $menuCompartido->setMenu($this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($data['menu']));
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readMenuCompartidoCollection($idUsuario) {
        try {
            $menusCompartidos = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->findByIdReceptor($idUsuario);
            $listaMenusCompartidos = array();
            foreach ($menusCompartidos as $i => $menuCompartido) {
                $listaMenusCompartidos[$i]['id'] = $menuCompartido->getId();
                $emisor = $menuCompartido->getEmisor();
                $listaMenusCompartidos[$i]['emisor'] = $emisor->getId();
                $menu = $menuCompartido->getMenu();
                $listaMenusCompartidos[$i]['menu'] = $menu->getId();
            }
            $resultado['listaMenusCompartidos'] = $listaMenusCompartidos;
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

    public function updateMenuCompartido($id) {
        try {
            $menuCompartido = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->find($id);
            $menuCompartido->setVisitado(true);

            $errors = $this->validator->validate($menuCompartido);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($menuCompartido);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $menuCompartido->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function deleteMenuCompartido($id) {
        try {
            $menuCompartido = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->find($id);
            $this->em->remove($menuCompartido);
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
