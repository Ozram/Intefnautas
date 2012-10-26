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

}
