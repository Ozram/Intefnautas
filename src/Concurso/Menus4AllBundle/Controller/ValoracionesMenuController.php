<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ValoracionesMenuController extends Controller {
    public function createValoracionMenuAction() {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.valoracionesMenumanager');
        $resultado = $rmService->createValoracionMenu($json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readValoracionMenuAction($id) {
        $rmService = $this->get('cm4all.valoracionesMenumanager');
        $resultado = $rmService->readValoracionMenu($id);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado['listaValoracionMenu']);
        return $this->sendResponse($data, $statusCode);
    }

    public function readValoracionesMenuCollectionAction() {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.valoracionesMenumanager');
        $resultado = $rmService->readValoracionMenuCollection($json);
        $statusCode = $resultado['statusCode'];
        if ($statusCode == 200){
            $data = json_encode($resultado['listaValoracionesMenu']);
        }else{
            $data = json_encode($resultado);
        }
        return $this->sendResponse($data, $statusCode);
    }

    public function updateValoracionMenuAction($id) {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.valoracionesMenumanager');
        $resultado = $rmService->updateValoracionMenu($id, $json);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    protected function sendResponse($result, $status_code) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($result);
        $response->setStatusCode($status_code);
        return $response;
    }

}