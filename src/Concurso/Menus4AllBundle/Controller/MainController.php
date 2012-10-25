<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Concurso\Menus4AllBundle\Entity\Receta;
use Concurso\Menus4AllBundle\Form\Type\RecetaType;
use Concurso\Menus4AllBundle\Form\Type\IngredienteType;

class MainController extends Controller {

    public function indexAction() {
        $receta = new Receta();
        $form = $this->createForm(new RecetaType(), $receta);
        return $this->render('ConcursoMenus4AllBundle::index.html.twig', array('form' => $form->createView()));
    }
}
?>
