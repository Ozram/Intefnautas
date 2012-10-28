<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenusCompartidosController extends Controller {

    public function createMenuCompartidoAction() {
        $json = $this->getRequest()->getContent();
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $rmService = $this->get('cm4all.menusCompartidosmanager');
        $resultado = $rmService->createMenuCompartido($json, $idUsuario);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readMenusCompartidosCollectionAction() {
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $rmService = $this->get('cm4all.menusCompartidosmanager');
        $resultado = $rmService->readMenuCompartidoCollection($idUsuario);
        $statusCode = $resultado['statusCode'];
        if ($statusCode == 200) {
            $data = json_encode($resultado['listaMenusCompartidos']);
        } else {
            $data = json_encode($resultado);
        }
        return $this->sendResponse($data, $statusCode);
    }

    public function updateMenuCompartidoAction($id) {
        $rmService = $this->get('cm4all.menusCompartidosmanager');
        $resultado = $rmService->updateMenuCompartido($id);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function deleteMenuCompartidoAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.menusCompartidosmanager');
        $resultado = $rmService->deleteMenuCompartido($json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode(NULL);
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