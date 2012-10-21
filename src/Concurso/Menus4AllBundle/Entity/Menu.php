<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Concurso\Menus4AllBundle\Entity\Menu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\MenuRepository")
 */
class Menu {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Valoracion")
     */
    private $valoracion;

    /**
     * @ORM\ManyToOne(targetEntity="TipoMenu")
     */
    private $tipo_menu;

    /**
     * @ORM\ManyToMany(targetEntity="Receta", inversedBy="menus")
     */
    private $recetas;

    public function __construct() {
        $this->recetas = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Menu
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Menu
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }


    /**
     * Set usuario
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $usuario
     * @return Menu
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

    /**
     * Set valoracion
     *
     * @param Concurso\Menus4AllBundle\Entity\Valoracion $valoracion
     * @return Menu
     */
    public function setValoracion(\Concurso\Menus4AllBundle\Entity\Valoracion $valoracion = null)
    {
        $this->valoracion = $valoracion;
    
        return $this;
    }

    /**
     * Get valoracion
     *
     * @return Concurso\Menus4AllBundle\Entity\Valoracion 
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * Set tipo_menu
     *
     * @param Concurso\Menus4AllBundle\Entity\TipoMenu $tipoMenu
     * @return Menu
     */
    public function setTipoMenu(\Concurso\Menus4AllBundle\Entity\TipoMenu $tipoMenu = null)
    {
        $this->tipo_menu = $tipoMenu;
    
        return $this;
    }

    /**
     * Get tipo_menu
     *
     * @return Concurso\Menus4AllBundle\Entity\TipoMenu 
     */
    public function getTipoMenu()
    {
        return $this->tipo_menu;
    }

    /**
     * Add recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     * @return Menu
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
}