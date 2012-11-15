<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\ValoracionMenu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\ValoracionMenuRepository")
 */
class ValoracionMenu {

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
     * @ORM\Column(name="comentario", type="text")
     */
    private $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="valoraciones")
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="valoracionMenu")
     */
    private $usuario;

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
     * @return ValoracionMenu
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
     * @return ValoracionMenu
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
     * Set menu
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menu
     * @return ValoracionMenu
     */
    public function setMenu(\Concurso\Menus4AllBundle\Entity\Menu $menu = null) {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return Concurso\Menus4AllBundle\Entity\Menu 
     */
    public function getMenu() {
        return $this->menu;
    }


    /**
     * Set usuario
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $usuario
     * @return ValoracionMenu
     */
    public function setUsuario(\Concurso\Menus4AllBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return Concurso\Menus4AllBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}