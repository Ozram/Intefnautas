<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\Receta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\RecetaRepository")
 */
class Receta {

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
     * @var integer $n_personas
     *
     * @ORM\Column(name="n_personas", type="integer")
     */
    private $n_personas;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Valoracion")
     */
    private $valoracion;

    /**
     * @ORM\ManyToMany(targetEntity="Ingrediente", inversedBy="recetas")
     */
    private $ingredientes;

    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="recetas")
     */
    private $menus;

    public function __construct() {
        $this->ingredientes = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Receta
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
     * @return Receta
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
     * Set n_personas
     *
     * @param integer $nPersonas
     * @return Receta
     */
    public function setNPersonas($nPersonas) {
        $this->n_personas = $nPersonas;

        return $this;
    }

    /**
     * Get n_personas
     *
     * @return integer 
     */
    public function getNPersonas() {
        return $this->n_personas;
    }


    /**
     * Set usuario
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $usuario
     * @return Receta
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
     * @return Receta
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
     * Add ingredientes
     *
     * @param Concurso\Menus4AllBundle\Entity\Ingrediente $ingredientes
     * @return Receta
     */
    public function addIngrediente(\Concurso\Menus4AllBundle\Entity\Ingrediente $ingredientes)
    {
        $this->ingredientes[] = $ingredientes;
    
        return $this;
    }

    /**
     * Remove ingredientes
     *
     * @param Concurso\Menus4AllBundle\Entity\Ingrediente $ingredientes
     */
    public function removeIngrediente(\Concurso\Menus4AllBundle\Entity\Ingrediente $ingredientes)
    {
        $this->ingredientes->removeElement($ingredientes);
    }

    /**
     * Get ingredientes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIngredientes()
    {
        return $this->ingredientes;
    }

    /**
     * Add menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     * @return Receta
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