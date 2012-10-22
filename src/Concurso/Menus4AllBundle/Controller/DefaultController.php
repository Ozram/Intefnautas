<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $receta = $em->getRepository('ConcursoMenus4AllBundle:Receta')->find(28);
        $ingredientesReceta = $receta->getIngredientesReceta();
        $cantidadtotal = $ingredientesReceta[0]->getCantidad() + $ingredientesReceta[1]->getCantidad();
  
        return $this->render('ConcursoMenus4AllBundle:Default:index.html.twig', array('name' => $cantidadtotal));
    }
}
