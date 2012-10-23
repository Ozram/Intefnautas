<?php

namespace Concurso\Menus4AllBundle\Services;

use Concurso\Menus4AllBundle\Entity\Receta;

class RecetasManager {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function createReceta($json) {
        $receta1 = new Receta();
        

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