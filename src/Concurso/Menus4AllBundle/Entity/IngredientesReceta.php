<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\IngredientesReceta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\IngredientesRecetaRepository")
 */
class IngredientesReceta {

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
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="ingredientesReceta")
     */
    private $receta;

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
     * @return IngredientesReceta
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
     * Set receta
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $receta
     * @return IngredientesReceta
     */
    public function setReceta(\Concurso\Menus4AllBundle\Entity\Receta $receta = null) {
        $this->receta = $receta;

        return $this;
    }

    /**
     * Get receta
     *
     * @return Concurso\Menus4AllBundle\Entity\Receta 
     */
    public function getReceta() {
        return $this->receta;
    }


    /**
     * Set ingrediente
     *
     * @param Concurso\Menus4AllBundle\Entity\Ingrediente $ingrediente
     * @return IngredientesReceta
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