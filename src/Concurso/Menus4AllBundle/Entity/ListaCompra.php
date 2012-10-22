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
     * @ORM\OneToMany(targetEntity="IngredientesListaCompra", mappedBy="lista_compra", cascade={"persist"}))
     */
    private $ingredientesListaCompra;

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
    public function setUsuario(\Concurso\Menus4AllBundle\Entity\Usuario $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return Concurso\Menus4AllBundle\Entity\Usuario 
     */
    public function getUsuario() {
        return $this->usuario;
    }

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredientesListaCompra = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
 

    /**
     * Add ingredientesListaCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesListaCompra $ingredientesListaCompra
     * @return ListaCompra
     */
     public function addIngrediente(\Concurso\Menus4AllBundle\Entity\Ingrediente $ingrediente, $cantidad)
    {    
        $ingredientesListaCompra = new \Concurso\Menus4AllBundle\Entity\IngredientesListaCompra();
        $ingredientesListaCompra->setIngrediente($ingrediente)->setCantidad($cantidad)->setListaCompra($this);
        $this->ingredientesListaCompra[] = $ingredientesListaCompra;
    
        return $this;
    }

    /**
     * Remove ingredientesListaCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesListaCompra $ingredientesListaCompra
     */
    public function removeIngredientesListaCompra(\Concurso\Menus4AllBundle\Entity\IngredientesListaCompra $ingredientesListaCompra)
    {
        $this->ingredientesListaCompra->removeElement($ingredientesListaCompra);
    }

    /**
     * Get ingredientesListaCompra
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIngredientesListaCompra()
    {
        return $this->ingredientesListaCompra;
    }
}