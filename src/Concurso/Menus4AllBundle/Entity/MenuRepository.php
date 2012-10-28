<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends EntityRepository {

    public function getRecetasDescartadas($idsReceta,$idMenu) {
        $em = $this->getEntityManager();
        // Todas las recetas cuya id no se encuentra en el array recibido y pertenezca al menú actual
        $query = $em->createQuery("SELECT r FROM ConcursoMenus4AllBundle:Receta r JOIN ConcursoMenus4AllBundle:Menu m where r.id not in (:ids) AND m.id = :idMenu ")
                ->setParameters(array(
                    "ids" => $idsReceta,
                    "idMenu" => $idMenu
                )
        );

        return $query->getResult();
    }

}
