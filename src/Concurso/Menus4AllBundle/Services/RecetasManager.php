<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Receta;

class RecetasManager {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function createReceta($json) {
        $data = json_decode($json, true);
        $receta = new Receta();
        try {
            $receta->setNombre($data['nombre']);
            $receta->setDescripcion($data['descripcion']);
            $receta->setNPersonas($data['n_personas']);
            $this->em->persist($receta);
            $flushexc = $this->em->flush();
            $statusCode = 200;
            return $statusCode;
        } catch (\ErrorException $mapexc) {
            $statusCode = 500;
            return $statusCode;
        } catch (\Doctrine\ORM\OptimisticLockException $flushexc) {
            $statusCode = 500;
            return $statusCode;
        }
    }

    public function readReceta($id) {
        return $id . ' has been read';
    }

    public function readRecetaCollection($data) {
        return 'Receta collection';
    }

    public function updateReceta($id, $data) {
        return $id . ' has been updated';
    }

    public function deleteReceta($id) {
        return $id . ' has been deleted';
    }

}