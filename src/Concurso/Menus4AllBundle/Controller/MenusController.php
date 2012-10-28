<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenusController extends Controller {


    public function createMenuAction() {
        $json = $this->getRequest()->getContent();
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $rmService = $this->get('cm4all.menusmanager');
        $resultado = $rmService->createMenu($json, $idUsuario);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readMenuAction($id) {
        $rmService = $this->get('cm4all.menusmanager');
        $resultado = $rmService->readMenu($id);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado['listaMenu']);
        return $this->sendResponse($data, $statusCode);
    }

    public function readMenusCollectionAction() {
        $rmService = $this->get('cm4all.menusmanager');
        $resultado = $rmService->readMenuCollection();
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado['listaMenus']);
        return $this->sendResponse($data, $statusCode);
    }

    public function updateMenuAction($id) {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.menusmanager');
        $resultado = $rmService->updateMenu($id, $json);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function deleteMenuAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.menusmanager');
        $resultado = $rmService->deleteMenu($json);
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