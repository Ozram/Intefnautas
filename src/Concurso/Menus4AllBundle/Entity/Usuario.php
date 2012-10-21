<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Concurso\Menus4AllBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\UsuarioRepository")
 */
class Usuario extends BaseUser {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $apellidos
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\OneToMany(targetEntity="Receta", mappedBy="usuario")
     */
    private $recetas;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="usuario")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="ListaCompra", mappedBy="usuario")
     */
    private $listasCompra;

    public function __construct() {
        parent::__construct();
        $this->recetas = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->listasCompra = new ArrayCollection();
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
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
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
     * Set apellidos
     *
     * @param string $apellidos
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos() {
        return $this->apellidos;
    }


    /**
     * Add recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     * @return Usuario
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
     * @return Usuario
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

    /**
     * Add listasCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra
     * @return Usuario
     */
    public function addListasCompra(\Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra)
    {
        $this->listasCompra[] = $listasCompra;
    
        return $this;
    }

    /**
     * Remove listasCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra
     */
    public function removeListasCompra(\Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra)
    {
        $this->listasCompra->removeElement($listasCompra);
    }

    /**
     * Get listasCompra
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListasCompra()
    {
        return $this->listasCompra;
    }
}