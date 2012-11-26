<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Concurso\Menus4AllBundle\Entity\Receta;
use Concurso\Menus4AllBundle\Form\Type\RecetaType;
use Concurso\Menus4AllBundle\Form\Type\IngredienteType;

class RecetasController extends Controller {
    public function createRecetaAction() {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->createReceta($json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readRecetaAction($id) {
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->readReceta($id);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado['listaReceta']);
        return $this->sendResponse($data, $statusCode);
    }

    public function readRecetasCollectionAction() {
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->readRecetaCollection();
        $statusCode = $resultado['statusCode'];
        if ($statusCode == 200){
            $data = json_encode($resultado['listaRecetas']);
        }else{
            $data = json_encode($resultado);
        }
        return $this->sendResponse($data, $statusCode);
    }

    public function updateRecetaAction($id) {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->updateReceta($id, $json);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function deleteRecetaAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasmanager');
        $resultado = $rmService->deleteReceta($json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode(NULL);
        return $this->sendResponse($data, $statusCode);
    }

    protected function sendResponse($result, $status_code) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json;charset=UTF-8');
        //$response->headers->set('Content-Type', 'application/json');
        $response->setContent($result);
        $response->setStatusCode($status_code);
        return $response;
    }

}