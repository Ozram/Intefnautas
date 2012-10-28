<?php // 
namespace Concurso\Recetas4AllBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RecetasCompartidasController extends Controller {

    public function createRecetaCompartidoAction() {
        $json = $this->getRequest()->getContent();
        $session = $this->getRequest()->getSession();
        $idUsuario = $session->getId();
        $rmService = $this->get('cm4all.recetasCompartidosmanager');
        $resultado = $rmService->createRecetaCompartido($json,$idUsuario);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function readRecetasCompartidasCollectionAction() {
        $rmService = $this->get('cm4all.recetasCompartidasmanager');
        $resultado = $rmService->readRecetaCompartidaCollection();
        $statusCode = $resultado['statusCode'];
        if ($statusCode == 200) {
            $data = json_encode($resultado['listaRecetasCompartidas']);
        } else {
            $data = json_encode($resultado);
        }
        return $this->sendResponse($data, $statusCode);
    }

    public function updateRecetaCompartidaAction($id) {
        $json = $this->getRequest()->getContent();
        $rmService = $this->get('cm4all.recetasCompartidasmanager');
        $resultado = $rmService->updateRecetaCompartida($id, $json);
        $statusCode = $resultado['statusCode'];
        $data = json_encode($resultado);
        return $this->sendResponse($data, $statusCode);
    }

    public function deleteRecetaCompartidaAction($id) {
        $json = $this->getRequest()->get('json');
        $rmService = $this->get('cm4all.recetasCompartidasmanager');
        $resultado = $rmService->deleteRecetaCompartida($json);
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