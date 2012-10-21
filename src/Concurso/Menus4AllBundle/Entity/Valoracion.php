<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Concurso\Menus4AllBundle\Entity\Valoracion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\ValoracionRepository")
 */
class Valoracion {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $puntuacion
     *
     * @ORM\Column(name="puntuacion", type="integer")
     */
    private $puntuacion;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     */
    private $comentario;

    /**
     * @ORM\OneToMany(targetEntity="Receta", mappedBy="valoracion")
     */
    private $recetas;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="valoracion")
     */
    private $menus;

    public function __construct() {
        $this->recetas = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set puntuacion
     *
     * @param integer $puntuacion
     * @return Valoracion
     */
    public function setPuntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Get puntuacion
     *
     * @return integer 
     */
    public function getPuntuacion() {
        return $this->puntuacion;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Valoracion
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario() {
        return $this->comentario;
    }


    /**
     * Add recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     * @return Valoracion
     */
    public function addReceta(\Concurso\Menus4AllBundle\Entity\Receta $recetas)
    {
        $this->recetas[] = $recetas;
    
        return $this;
    }

    /**
     * Remove recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     */
    public function removeReceta(\Concurso\Menus4AllBundle\Entity\Receta $recetas)
    {
        $this->recetas->removeElement($recetas);
    }

    /**
     * Get recetas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecetas()
    {
        return $this->recetas;
    }

    /**
     * Add menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     * @return Valoracion
     */
    public function addMenu(\Concurso\Menus4AllBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;
    
        return $this;
    }

    /**
     * Remove menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     */
    public function removeMenu(\Concurso\Menus4AllBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }
}