<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\Ingrediente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\IngredienteRepository")
 */
class Ingrediente {

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
     * @var integer $calorias
     *
     * @ORM\Column(name="calorias", type="integer")
     */
    private $calorias;

    /**
     * @var float $carbohidratos
     *
     * @ORM\Column(name="carbohidratos", type="float")
     */
    private $carbohidratos;

    /**
     * @var float $grasas
     *
     * @ORM\Column(name="grasas", type="float")
     */
    private $grasas;

    /**
     * @var float $proteinas
     *
     * @ORM\Column(name="proteinas", type="float")
     */
    private $proteinas;

    /**
     * @ORM\ManyToMany(targetEntity="Receta", mappedBy="ingredientes")
     */
    private $recetas;

    /**
     * @ORM\ManyToMany(targetEntity="ListaCompra", mappedBy="ingredientes")
     */
    private $listasCompra;

    public function __construct() {
        $this->recetas = new ArrayCollection();
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
     * @return Ingrediente
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
     * Set calorias
     *
     * @param integer $calorias
     * @return Ingrediente
     */
    public function setCalorias($calorias) {
        $this->calorias = $calorias;

        return $this;
    }

    /**
     * Get calorias
     *
     * @return integer 
     */
    public function getCalorias() {
        return $this->calorias;
    }

    /**
     * Set carbohidratos
     *
     * @param float $carbohidratos
     * @return Ingrediente
     */
    public function setCarbohidratos($carbohidratos) {
        $this->carbohidratos = $carbohidratos;

        return $this;
    }

    /**
     * Get carbohidratos
     *
     * @return float 
     */
    public function getCarbohidratos() {
        return $this->carbohidratos;
    }

    /**
     * Set grasas
     *
     * @param float $grasas
     * @return Ingrediente
     */
    public function setGrasas($grasas) {
        $this->grasas = $grasas;

        return $this;
    }

    /**
     * Get grasas
     *
     * @return float 
     */
    public function getGrasas() {
        return $this->grasas;
    }

    /**
     * Set proteinas
     *
     * @param float $proteinas
     * @return Ingrediente
     */
    public function setProteinas($proteinas) {
        $this->proteinas = $proteinas;

        return $this;
    }

    /**
     * Get proteinas
     *
     * @return float 
     */
    public function getProteinas() {
        return $this->proteinas;
    }


    /**
     * Add recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     * @return Ingrediente
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
     * Add listasCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra
     * @return Ingrediente
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