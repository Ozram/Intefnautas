<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * -------------validadores-------------
     * @Assert\NotBlank(message = "El nombre no puede estar vacío")
     * @Assert\Length(
     *  min = "5",
     *  max = "255",
     *  minMessage = "El nombre de la receta no puede contener menos de 5 caracteres alfanuméricos",
     *  maxMessage = "El nombre de la receta no puede contener más de 255 caracteres alfanuméricos"
     * )
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $descripcion
     * -------------validadores-------------
     * @Assert\NotBlank(message = "La descripción no puede estar vacía")
     * @Assert\Length(
     *  min = "100",
     *  max = "10000",
     *  minMessage = "La descripción no puede tener menos de 100 caracteres",
     *  maxMessage = "La descripción es demasiado larga, no nos cuentes tu vida"
     * )
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var integer $n_personas
     * -------------validadores-------------
     * @Assert\NotBlank(message = "Debes poner el número de comensales")
     * @Assert\Range(
     *  min = "1",
     *  max = "1000",
     *  minMessage = "La receta tiene que ser para un mínimo de un comensal",
     *  maxMessage = "Demasiados comensales, el máximo es de 1000"
     * )
     * @Assert\Type(type="integer", message="El valor {{ value }} no del tipo valido {{ type }}.")
     * 
     * @ORM\Column(name="n_personas", type="integer")
     */
    private $n_personas;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="recetas")
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="ValoracionReceta", mappedBy="receta")
     */
    private $valoraciones;

    /**
     * @ORM\OneToMany(targetEntity="IngredientesReceta", mappedBy="receta", cascade={"persist"}))
     */
    private $ingredientesReceta;


    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="recetas")
     */
    private $menus;
    
    /**
     * @ORM\OneToMany(targetEntity="RecetaCompartida", mappedBy="receta")
     */
    private $recetasCompartidas;

    public function __construct() {
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
     * Add menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     * @return Receta
     */
    public function addMenu(\Concurso\Menus4AllBundle\Entity\Menu $menus) {
        $this->menus[] = $menus;

        return $this;
    }

    /**
     * Remove menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     */
    public function removeMenu(\Concurso\Menus4AllBundle\Entity\Menu $menus) {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMenus() {
        return $this->menus;
    }


  

    /**
     * Add ingredientesReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta
     * @return Receta
     */
    public function addIngredientes(\Concurso\Menus4AllBundle\Entity\Ingrediente $ingrediente, $cantidad)
    {    
        $ingredientesReceta = new \Concurso\Menus4AllBundle\Entity\IngredientesReceta();
        $ingredientesReceta->setIngrediente($ingrediente)->setCantidad($cantidad)->setReceta($this);
        $this->ingredientesReceta[] = $ingredientesReceta;
    
        return $this;
    }

    /**
     * Remove ingredientesReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta
     */
    public function removeIngredientes(\Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta)
    {
        $this->ingredientesReceta->removeElement($ingredientesReceta);
    }

    /**
     * Get ingredientesReceta
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIngredientesReceta()
    {
        return $this->ingredientesReceta;
    }

    /**
     * Add valoraciones
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoraciones
     * @return Receta
     */
    public function addValoracione(\Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoraciones)
    {
        $this->valoraciones[] = $valoraciones;
    
        return $this;
    }

    /**
     * Remove valoraciones
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoraciones
     */
    public function removeValoracione(\Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoraciones)
    {
        $this->valoraciones->removeElement($valoraciones);
    }

    /**
     * Get valoraciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getValoraciones()
    {
        return $this->valoraciones;
    }

    /**
     * Add ingredientesReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta
     * @return Receta
     */
    public function addIngredientesReceta(\Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta)
    {
        $this->ingredientesReceta[] = $ingredientesReceta;
    
        return $this;
    }

    /**
     * Remove ingredientesReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta
     */
    public function removeIngredientesReceta(\Concurso\Menus4AllBundle\Entity\IngredientesReceta $ingredientesReceta)
    {
        $this->ingredientesReceta->removeElement($ingredientesReceta);
    }

    /**
     * Add recetasCompartidas
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidas
     * @return Receta
     */
    public function addRecetasCompartida(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidas)
    {
        $this->recetasCompartidas[] = $recetasCompartidas;
    
        return $this;
    }

    /**
     * Remove recetasCompartidas
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidas
     */
    public function removeRecetasCompartida(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidas)
    {
        $this->recetasCompartidas->removeElement($recetasCompartidas);
    }

    /**
     * Get recetasCompartidas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecetasCompartidas()
    {
        return $this->recetasCompartidas;
    }
}