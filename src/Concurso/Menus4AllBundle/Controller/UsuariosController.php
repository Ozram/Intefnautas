<?php

namespace Concurso\Menus4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsuariosController extends Controller {

    public function readUsuarioAction($id) {
        $rmService = $this->get('cm4all.usuariosmanager');
        $resultado = $rmService->readUsuario($id);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado['listaUsuario']);
        return $this->sendResponse($data, $statusCode);
    }

    public function readNumNotificacionesUsuarioAction() {
        $rmService = $this->get('cm4all.usuariosmanager');
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $resultado = $rmService->readNumNotificacionesUsuario($idUsuario);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado['listaNotificacion']);
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