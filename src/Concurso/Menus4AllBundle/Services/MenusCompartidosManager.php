<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\MenuCompartido;

class MenusCompartidosManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createMenuCompartido($json) {
        $data = json_decode($json, true);
        $idUsuario = $session->getId();
        $menuCompartido = new MenuCompartido();
        try {
            $menuCompartido->setUsuario($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($idUsuario));
            $menuCompartido->setNombre($data['nombre']);
            
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readMenuCompartido($id) {
        try {
            $menuCompartido = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->find($id);
            $listaMenuCompartido['id'] = $menuCompartido->getId();
            $listaMenuCompartido['nombre'] = $menuCompartido->getNombre();
            $listaMenuCompartido['idUsuario'] = $menuCompartido->getUsuario()->getId();
            $ingredientesMenuCompartido = $menuCompartido->getIngredientesMenuCompartido();
            foreach ($ingredientesMenuCompartido as $i => $ingredienteMenuCompartido) {
                $listaMenuCompartido['ingredientes'][$i]['cantidad'] = $ingredienteMenuCompartido->getCantidad();
                $ingrediente = $ingredienteMenuCompartido->getIngrediente();
                $listaMenuCompartido['ingredientes'][$i]['nombre'] = $ingrediente->getNombre();
            }
            $resultado['listaMenuCompartido'] = $listaMenuCompartido;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readMenuCompartidoCollection() {
        try {
            $listasCompra = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->findAll();
            $listaMenusCompartidos = array();
            foreach ($listasCompra as $i => $menuCompartido) {
                $menuCompartido = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->find($id);
                $listaMenusCompartidos[$i]['id'] = $menuCompartido->getId();
                $listaMenusCompartidos[$i]['nombre'] = $menuCompartido->getNombre();
                $listaMenusCompartidos[$i]['idUsuario'] = $menuCompartido->getUsuario()->getId();
                $ingredientesMenuCompartido = $menuCompartido->getIngredientesMenuCompartido();
                foreach ($ingredientesMenuCompartido as $k => $ingredienteMenuCompartido) {
                    $listaMenusCompartidos[$i]['ingredientes'][$k]['cantidad'] = $ingredienteMenuCompartido->getCantidad();
                    $ingrediente = $ingredienteMenuCompartido->getIngrediente();
                    $listaMenusCompartidos[$i]['ingredientes'][$k]['nombre'] = $ingrediente->getNombre();
                }
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

    public function updateMenuCompartido($id, $json) {
        $data = json_decode($json, true);
        try {
            $menuCompartido = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->find($id);

            $menuCompartido->setNombre($data['nombre']);
            if (empty($data['recetas']) && empty($data['menus'])) {
                $resultado['statusCode'] = 500;
                $resultado['errores']['QueMeEstasContainer'] = 'El menú debe tener al menos una receta asociada';
                return $resultado;
            }
            $idsIngredientes = array();
            $listaIngredientes = array();
            if (!empty($data['recetas'])) {
                foreach ($data['recetas'] as $idReceta) {
                    $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($idReceta);
                    $ingredientesReceta = $receta->getIngredientesReceta();
                    foreach ($ingredientesReceta as $ingredienteReceta) {
                        if (empty($isdIngredientesRecetaMenuCompartido[$ingredienteReceta->getId()])) {
                            $isdIngredientesRecetaMenuCompartido[$ingredienteReceta->getId()] = $ingredienteReceta->getId();
                        }
                        if (empty($listaIngredientes[$ingredienteLista->getNombre()])) {
                            $listaIngredientes[$ingredienteLista->getNombre()]['obj'] = $ingredienteLista;
                            $listaIngredientes[$ingredienteLista->getNombre()]['cantidad'] = 1;
                        } else {
                            $listaIngredientes[$ingredienteLista->getNombre()]['cantidad']++;
                        }
                    }
                }
            }
            if (!empty($data['menus'])) {
                foreach ($data['menus'] as $idMenu) {
                    $menu = $this->em->getRepository('ConcursoMenus4AllBundle:Menu')->find($idMenu);
                    $recetas = $menu->getRecetas();
                    foreach ($recetas as $receta) {
                        $ingredientesReceta = $receta->getIngredientesReceta();
                        foreach ($ingredientesReceta as $ingredienteReceta) {
                            if (empty($isdIngredientesRecetaMenuCompartido[$ingredienteReceta->getId()])) {
                                $isdIngredientesRecetaMenuCompartido[$ingredienteReceta->getId()] = $ingredienteReceta->getId();
                            }
                            if (empty($listaIngredientes[$ingredienteLista->getNombre()])) {
                                $listaIngredientes[$ingredienteLista->getNombre()]['obj'] = $ingredienteLista;
                                $listaIngredientes[$ingredienteLista->getNombre()]['cantidad'] = 1;
                            } else {
                                $listaIngredientes[$ingredienteLista->getNombre()]['cantidad']++;
                            }
                        }
                    }
                }
            }
            $ingredientesDescartados = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->getIngredientesMenuCompartidoDescartados($idsIngredientes);
            $menuCompartido->removeIngredientesMenuCompartido($ingredientesDescartados);
            $idsIngredientesExistentes = array();
            $ingredientesMenuCompartido = $menuCompartido->getIngredientesMenuCompartido();
            foreach ($ingredientesMenuCompartido as $ingredienteMenuCompartido) {
                $ingredientesExistentes[$ingredienteMenuCompartido->getIngrediente()->getId()]['obj'] = $ingredienteMenuCompartido->getIngrediente();
                $ingredientesExistentes[$ingredienteMenuCompartido->getIngrediente()->getId()]['cantidad'] = $ingredienteMenuCompartido->getCantidad();
                $idsIngredientesExistentes[] = $ingredienteExistente->getId();
            }
            foreach ($listaIngredientes as $ingrediente) {
                if (in_array($ingrediente['obj']->getId(), $idsIngredientesExistentes)) {
                    $cantAux = $ingredientesExistentes[$ingrediente['obj']->getId()]['cantidad'] + $ingrediente['cantidad'];
                    $menuCompartido->addIngrediente($ingrediente['obj'], $cantAux);
                }
                else{
                    $menuCompartido->addIngrediente($ingrediente['obj'], $ingrediente['cantidad']);
                }
            }


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
