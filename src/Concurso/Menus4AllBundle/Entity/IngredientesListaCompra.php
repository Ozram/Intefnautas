<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\IngredientesListaCompra
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\IngredientesListaCompraRepository")
 */
class IngredientesListaCompra {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="ListaCompra")
     */
    private $listaCompra;

    /**
     * @ORM\ManyToOne(targetEntity="Ingrediente")
     */
    private $ingrediente;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return IngredientesListaCompra
     */
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Set listaCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listaCompra
     * @return IngredientesListaCompra
     */
    public function setListaCompra(\Concurso\Menus4AllBundle\Entity\ListaCompra $listaCompra = null) {
        $this->listaCompra = $listaCompra;

        return $this;
    }

    /**
     * Get listaCompra
     *
     * @return Concurso\Menus4AllBundle\Entity\ListaCompra 
     */
    public function getListaCompra() {
        return $this->listaCompra;
    }


    /**
     * Set ingrediente
     *
     * @param Concurso\Menus4AllBundle\Entity\Ingrediente $ingrediente
     * @return IngredientesListaCompra
     */
    public function setIngrediente(\Concurso\Menus4AllBundle\Entity\Ingrediente $ingrediente = null)
    {
        $this->ingrediente = $ingrediente;
    
        return $this;
    }

    /**
     * Get ingrediente
     *
     * @return Concurso\Menus4AllBundle\Entity\Ingrediente 
     */
    public function getIngrediente()
    {
        return $this->ingrediente;
    }
}