<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ListasCompraController extends Controller {
    public function createListaCompraAction() {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.listaComprasmanager');
        $resultado = $rmService->createListaCompra($json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readListaCompraAction($id) {
        $rmService = $this->get('cm4all.listaComprasmanager');
        $resultado = $rmService->readListaCompra($id);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado['listaListaCompra']);
        return $this->sendResponse($data, $statusCode);
    }

    public function readListasCompraCollectionAction() {
        $rmService = $this->get('cm4all.listaComprasmanager');
        $resultado = $rmService->readListaCompraCollection();
        $statusCode = $resultado['statusCode'];
        if ($statusCode == 200){
            $data = json_encode($resultado['listaListasCompra']);
        }else{
            $data = json_encode($resultado);
        }
        return $this->sendResponse($data, $statusCode);
    }

    public function updateListaCompraAction($id) {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.listaComprasmanager');
        $resultado = $rmService->updateListaCompra($id, $json);
        $statusCode = $resultado['statusCode'];       
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function deleteListaCompraAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.listaComprasmanager');
        $resultado = $rmService->deleteListaCompra($json);
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