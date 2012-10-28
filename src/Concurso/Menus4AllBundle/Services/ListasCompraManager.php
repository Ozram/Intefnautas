<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\ListaCompra;

class ListasCompraManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function createListaCompra($json) {
        $data = json_decode($json, true);
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $listaCompra = new ListaCompra();
        try {
            $listaCompra->setUsuario($this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($idUsuario));
            $listaCompra->setNombre($data['nombre']);
            $listaIngredientes = array();
            if (!empty($data['recetas'])) {
                foreach ($data['recetas'] as $idReceta) {
                    $receta = $this->em->getRepository('ConcursoMenus4AllBundle:Receta')->find($idReceta);
                    $ingredientesReceta = $receta->getIngredientesReceta();
                    foreach ($ingredientesReceta as $i => $ingredienteReceta) {
                        $ingredienteLista = $ingredienteReceta->getIngrediente();
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
                    $recetasMenu = $menu->getRecetas();
                    foreach ($recetasMenu as $receta) {
                        $ingredientesReceta = $receta->getIngredientesReceta();
                        foreach ($ingredientesReceta as $i => $ingredienteReceta) {
                            $ingredienteLista = $ingredienteReceta->getIngrediente();
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
            foreach ($listaIngredientes as $ingredienteListaCompra) {
                $listaCompra->addIngrediente($ingredienteListaCompra['obj'], $ingredienteListaCompra['cantidad']);
            }

            $errors = $this->validator->validate($listaCompra);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($listaCompra);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $listaCompra->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readListaCompra($id) {
        try {
            $listaCompra = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->find($id);
            $listaListaCompra['id'] = $listaCompra->getId();
            $listaListaCompra['nombre'] = $listaCompra->getNombre();
            $listaListaCompra['idUsuario'] = $listaCompra->getUsuario()->getId();
            $ingredientesListaCompra = $listaCompra->getIngredientesListaCompra();
            foreach ($ingredientesListaCompra as $i => $ingredienteListaCompra) {
                $listaListaCompra['ingredientes'][$i]['cantidad'] = $ingredienteListaCompra->getCantidad();
                $ingrediente = $ingredienteListaCompra->getIngrediente();
                $listaListaCompra['ingredientes'][$i]['nombre'] = $ingrediente->getNombre();
            }
            $resultado['listaListaCompra'] = $listaListaCompra;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readListaCompraCollection() {
        try {
            $listasCompra = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->findAll();
            $listaListasCompra = array();
            foreach ($listasCompra as $i => $listaCompra) {
                $listaCompra = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->find($id);
                $listaListasCompra[$i]['id'] = $listaCompra->getId();
                $listaListasCompra[$i]['nombre'] = $listaCompra->getNombre();
                $listaListasCompra[$i]['idUsuario'] = $listaCompra->getUsuario()->getId();
                $ingredientesListaCompra = $listaCompra->getIngredientesListaCompra();
                foreach ($ingredientesListaCompra as $k => $ingredienteListaCompra) {
                    $listaListasCompra[$i]['ingredientes'][$k]['cantidad'] = $ingredienteListaCompra->getCantidad();
                    $ingrediente = $ingredienteListaCompra->getIngrediente();
                    $listaListasCompra[$i]['ingredientes'][$k]['nombre'] = $ingrediente->getNombre();
                }
            }
            $resultado['listaListasCompra'] = $listaListasCompra;
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

    public function updateListaCompra($id, $json) {
        $data = json_decode($json, true);
        try {
            $listaCompra = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->find($id);

            $listaCompra->setNombre($data['nombre']);
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
                        if (empty($isdIngredientesRecetaListaCompra[$ingredienteReceta->getId()])) {
                            $isdIngredientesRecetaListaCompra[$ingredienteReceta->getId()] = $ingredienteReceta->getId();
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
                            if (empty($isdIngredientesRecetaListaCompra[$ingredienteReceta->getId()])) {
                                $isdIngredientesRecetaListaCompra[$ingredienteReceta->getId()] = $ingredienteReceta->getId();
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
            $ingredientesDescartados = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->getIngredientesListaCompraDescartados($idsIngredientes);
            $listaCompra->removeIngredientesListaCompra($ingredientesDescartados);
            $idsIngredientesExistentes = array();
            $ingredientesListaCompra = $listaCompra->getIngredientesListaCompra();
            foreach ($ingredientesListaCompra as $ingredienteListaCompra) {
                $ingredientesExistentes[$ingredienteListaCompra->getIngrediente()->getId()]['obj'] = $ingredienteListaCompra->getIngrediente();
                $ingredientesExistentes[$ingredienteListaCompra->getIngrediente()->getId()]['cantidad'] = $ingredienteListaCompra->getCantidad();
                $idsIngredientesExistentes[] = $ingredienteExistente->getId();
            }
            foreach ($listaIngredientes as $ingrediente) {
                if (in_array($ingrediente['obj']->getId(), $idsIngredientesExistentes)) {
                    $cantAux = $ingredientesExistentes[$ingrediente['obj']->getId()]['cantidad'] + $ingrediente['cantidad'];
                    $listaCompra->addIngrediente($ingrediente['obj'], $cantAux);
                }
                else{
                    $listaCompra->addIngrediente($ingrediente['obj'], $ingrediente['cantidad']);
                }
            }


            $errors = $this->validator->validate($listaCompra);
            if (count($errors) > 0) {
                $resultado['statusCode'] = 422;
                foreach ($errors as $error) {
                    $resultado['errores'][$error->getPropertyPath()] = $error->getMessage();
                }
                return $resultado;
            }
            $this->em->persist($listaCompra);
            $flushexc = $this->em->flush();
            $resultado['statusCode'] = 200;
            $resultado['id'] = $listaCompra->getId();
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function deleteListaCompra($id) {
        try {
            $listaCompra = $this->em->getRepository('ConcursoMenus4AllBundle:ListaCompra')->find($id);
            $this->em->remove($listaCompra);
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
