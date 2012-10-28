<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Usuario;

class UsuariosManager {

    protected $em, $validator;

    public function __construct($em, $validator) {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function readUsuario($id) {
        try {
            $usuario = $this->em->getRepository('ConcursoMenus4AllBundle:Usuario')->find($id);
            $listaUsuario['id'] = $usuario->getId();
            $listaUsuario['username'] = $usuario->getUsername();

            $resultado['listaMenu'] = $listaUsuario;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

    public function readNumNotificacionesUsuario($idUsuario) {
        $listaNotificaciones['numRecetasCompartidas'] = 0;
        $listaNotificaciones['numMenusCompartidos'] = 0;
        try {
            $notificacionesUsuario['recetas'] = $this->em->getRepository('ConcursoMenus4AllBundle:RecetaCompartida')->getNovedades($idUsuario);
            $notificacionesUsuario['menus'] = $this->em->getRepository('ConcursoMenus4AllBundle:MenuCompartido')->getNovedades($idUsuario);
            
            $listaNotificaciones['numRecetasCompartidas'] = count($notificacionesUsuario['recetas']);
            $listaNotificaciones['numMenusCompartidos'] = count($notificacionesUsuario['menus']);

            $resultado['listaMenu'] = $listaUsuario;
            $resultado['statusCode'] = 200;
        } catch (\ErrorException $mapexc) {
            $resultado['statusCode'] = 500;
        } catch (\Exception $exc) {
            $resultado['statusCode'] = 500;
        }
        return $resultado;
    }

}