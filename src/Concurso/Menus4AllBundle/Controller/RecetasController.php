<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RecetasController extends Controller {

    public function indexAction() {
        return $this->render('ConcursoMenus4AllBundle:Recetas:index.html.twig', array('receta' => 'Galletas'));
    }

    public function createRecetaAction() {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $statusCode = $rmService->createReceta($json);
        $result = array('success' => array('message' => ''), 'error' => array('message' => ''));
        if ($statusCode == 200) {
            $result['success']['message'] = 'Receta creada correctamente';
            $result = json_encode($result);
        } else {
            $result['error']['message'] = 'Fallo al crear la receta';
            $result = json_encode($result);
        }

        return $this->sendResponse($result, $statusCode);
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

}