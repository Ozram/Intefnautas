<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Concurso\Menus4AllBundle\Entity\Receta;
use Concurso\Menus4AllBundle\Form\Type\RecetaType;
use Concurso\Menus4AllBundle\Form\Type\IngredienteType;

class RecetasController extends Controller {

    public function formNuevaAction() {        
        $receta = new Receta();
        $form = $this->createForm(new RecetaType(), $receta);
        return $this->render('ConcursoMenus4AllBundle:Recetas:nuevaReceta.html.twig', array('form' => $form->createView()));
    }

    public function createRecetaAction() {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->createReceta($json);
        $statusCode = $resultado['statusCode'];
        $resultado = json_encode($resultado);
        return $this->sendResponse($resultado, $statusCode);
    }

    public function readRecetaAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $statusCode = $rmService->readReceta($json);
        $result = json_encode(NULL);
        return $this->sendResponse($result, $statusCode);
    }

    public function readRecetaCollectionAction() {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $statusCode = $rmService->readRecetaCollection($json);
        $result = json_encode(NULL);
        return $this->sendResponse($result, $statusCode);
    }

    public function updateRecetaAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $statusCode = $rmService->updateReceta($json);
        $result = json_encode(NULL);
        return $this->sendResponse($result, $statusCode);
    }

    public function deleteRecetaAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $statusCode = $rmService->deleteReceta($json);
        $result = json_encode(NULL);
        return $this->sendResponse($result, $statusCode);
    }

    protected function sendResponse($result, $status_code) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($result);
        $response->setStatusCode($status_code);
        return $response;
    }

    protected function getErrorMessages(\Symfony\Component\Form\Form $form) {
        $errors = array();
        foreach ($form->getErrors() as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }

            $errors[$key] = $template;
        }
        if ($form->hasChildren()) {
            foreach ($form->getChildren() as $child) {
                if (!$child->isValid()) {
                    $errors[$child->getName()] = $this->getErrorMessages($child);
                }
            }
        }

        return $errors;
    }

}