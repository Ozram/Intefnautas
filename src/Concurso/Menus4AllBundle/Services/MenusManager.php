<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Menu;

class MenusManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createMenu($json, $idUsuario) {
        $data = json_decode($json, true);
        $menu = new Menu();
        try {
            $menu->setNombre($data['nombre']);
            $menu->setDescripcion($data['descripcion']);
            //$menu->setUsuario($idUsuario);
            
            $menu->setTipoMenu($this->em->getRepository('ConcursoMenus4AllBundle:TipoMenu')->findOneByNombre($data['tipo']));
            //se recorren las ids de recetas y se añaden al menu
//            if (empty($data['recetas'])) {
//                $resultado['statusCode'] = 500;
//                $resultado['errores']['QueMeEstasContainer'] = 'El menú debe tener al menos una receta asociada';
//                return $resultado;
//            }
            foreach ($data['recetas'] as $idReceta) {
                $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($idReceta);
                $menu->addReceta($receta);
            }
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

    public function readMenu($id) {
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $listaMenu['id'] = $menu->getId();
            $listaMenu['nombre'] = $menu->getNombre();
            $listaMenu['descripcion'] = $menu->getDescripcion();
            $recetasMenu = $menu->getRecetas();
            foreach ($recetasMenu as $i => $recetaMenu) {
                $listaMenu['recetas'][$i]['id'] = $recetaMenu->getId();
                $listaMenu['recetas'][$i]['nombre'] = $recetaMenu->getNombre();
                $listaMenu['recetas'][$i]['n_personas'] = $recetaMenu->getNPersonas();
            }
            $valoracionesMenu = $menu->getValoraciones();
            $puntuacionTotal = 0;
            foreach ($valoracionesMenu as $i => $valoracionMenu) {
                $listaMenu['valoraciones'][$i]['id'] = $valoracionMenu->getId();
                $listaMenu['valoraciones'][$i]['idAutor'] = $valoracionMenu->getUsuario()->getId();
                $listaMenu['valoraciones'][$i]['nombreAutor'] = $valoracionMenu->getUsuario()->getNombre();
                $listaMenu['valoraciones'][$i]['puntuacion'] = $valoracionMenu->getPuntuacion();
                $puntuacionTotal = $valoracionMenu->getPuntuacion() + $puntuacionTotal;
                $listaMenu['valoraciones'][$i]['comentario'] = $valoracionMenu->getComentario();
            }
            $listaMenu['valoracionMedia'] = $puntuacionTotal / ($i + 1);
            $listaMenu['tipo'] = $menu->getTipoMenu()->getNombre();
            $listaMenu['autor'] = $menu->getUsuario()->getNombre();
            $resultado['listaMenu'] = $listaMenu;
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

    public function readMenuCollection() {
        try {
            $menus = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->findAll();
            $listaMenus = array();
            foreach ($menus as $n => $menu) {
                $listaMenus[$n]['id'] = $menu->getId();
                $listaMenus[$n]['nombre'] = $menu->getNombre();
                $listaMenus[$n]['descripcion'] = $menu->getDescripcion();
                $recetasMenu = $menu->getRecetas();
                foreach ($recetasMenu as $i => $recetaMenu) {
                    $listaMenus[$n]['recetas'][$i]['id'] = $recetaMenu->getId();
                    $listaMenus[$n]['recetas'][$i]['nombre'] = $recetaMenu->getNombre();
                    $listaMenus[$n]['recetas'][$i]['n_personas'] = $recetaMenu->getNPersonas();
                }
                $valoracionesMenu = $menu->getValoraciones();
                $puntuacionTotal = 0;
                foreach ($valoracionesMenu as $i => $valoracionMenu) {
                    $listaMenus[$n]['valoraciones'][$i]['id'] = $valoracionMenu->getId();
                    $listaMenus[$n]['valoraciones'][$i]['idAutor'] = $valoracionMenu->getUsuario()->getId();
                    $listaMenus[$n]['valoraciones'][$i]['nombreAutor'] = $valoracionMenu->getUsuario()->getNombre();
                    $listaMenus[$n]['valoraciones'][$i]['puntuacion'] = $valoracionMenu->getPuntuacion();
                    $puntuacionTotal = $valoracionMenu->getPuntuacion() + $puntuacionTotal;
                    $listaMenus[$n]['valoraciones'][$i]['comentario'] = $valoracionMenu->getComentario();
                }
                $listaMenus[$n]['valoracionMedia'] = $puntuacionTotal / ($i + 1);
                $listaMenus[$n]['tipo'] = $menu->getTipoMenu()->getNombre();
                $listaMenus[$n]['autor'] = $menu->getUsuario()->getNombre();
            }
            $resultado['listaMenus'] = $listaMenus;
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

    public function updateMenu($id, $json) {
        $data = json_decode($json, true);
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $menu->setNombre($data['nombre']);
            $menu->setDescripcion($data['descripcion']);
//            if (empty($data['recetas'])) {
//                $resultado['statusCode'] = 500;
//                $resultado['errores']['QueMeEstasContainer'] = 'El menú debe tener al menos una receta asociada';
//                return $resultado;
//            }
//            $recetasDesc = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->getRecetasDescartadas($data['recetas'], $menu->getId());
//            if (!empty($recetasDesc)) {
//                foreach ($recetasDesc as $recetaDesc) {
//                    $menu->removeReceta($recetaDesc);
//                }
//            }
//            $recetasMenu = $menu->getRecetas();
//            $idsRecetaMenu = array();
//            foreach ($recetasMenu as $recetaMenu) {
//                $idsRecetaMenu[] = $recetaMenu->getId();
//            }
//            foreach ($data['recetas'] as $idReceta) {
//                if (!in_array($idReceta, $idsRecetaMenu)) {
//                    $nuevaRecetaMenu = $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($idReceta);
//                    $menu->addReceta($nuevaRecetaMenu);
//                }
//            }
            $menu->setTipoMenu($this->em->getRepository('ConcursoMenus4AllBundle:TipoMenu')->findOneByNombre($data['tipo']));
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

    public function deleteMenu($id) {
        try {
            $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($id);
            $this->em->remove($menu);
            $this->em->flush();
            $resultado['id'] = $id;
            $resultado['statusCode'] = 200;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $exc->getMessage();
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
            $resultado['error'] = $flushexc->getMessage();
        }
        return $resultado;
    }

}