<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Concurso\Menus4AllBundle\Entity\ListaCompra
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\ListaCompraRepository")
 */
class ListaCompra {

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
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $usuario;

    /**
     * @ORM\ManyToMany(targetEntity="Ingrediente", inversedBy="listas_compra")
     */
    private $ingredientes;

    public function __construct() {
        $this->ingredientes = new ArrayCollection();
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
     * @return ListaCompra
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
     * Set usuario
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $usuario
     * @return ListaCompra
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
     * Add ingredientes
     *
     * @param Concurso\Menus4AllBundle\Entity\Ingrediente $ingredientes
     * @return ListaCompra
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
}