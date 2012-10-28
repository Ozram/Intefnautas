<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Concurso\Menus4AllBundle\Entity\RecetaCompartida
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="recetaCompartidaUnica", columns={"idReceptor", "idEmisor", "idReceta"})})
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\RecetaCompartidaRepository")
 */
class RecetaCompartida {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $mensaje
     *
     * @ORM\Column(name="mensaje", type="string", length=255)
     */
    private $mensaje;

    /**
     * @var boolean $visitada
     *
     * @ORM\Column(name="visitada", type="boolean")
     */
    private $visitada;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $receptor;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $emisor;
    
    /**
     * @ORM\ManyToOne(targetEntity="Receta")
     */
    private $receta;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return RecetaCompartida
     */
    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Set visitada
     *
     * @param boolean $visitada
     * @return RecetaCompartida
     */
    public function setVisitada($visitada) {
        $this->visitada = $visitada;

        return $this;
    }

    /**
     * Get visitada
     *
     * @return boolean 
     */
    public function getVisitada() {
        return $this->visitada;
    }


    /**
     * Set receptor
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $receptor
     * @return RecetaCompartida
     */
    public function setReceptor(\Concurso\Menus4AllBundle\Entity\Usuario $receptor = null)
    {
        $this->receptor = $receptor;
    
        return $this;
    }

    /**
     * Get receptor
     *
     * @return Concurso\Menus4AllBundle\Entity\Usuario 
     */
    public function getReceptor()
    {
        return $this->receptor;
    }

    /**
     * Set emisor
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $emisor
     * @return RecetaCompartida
     */
    public function setEmisor(\Concurso\Menus4AllBundle\Entity\Usuario $emisor = null)
    {
        $this->emisor = $emisor;
    
        return $this;
    }

    /**
     * Get emisor
     *
     * @return Concurso\Menus4AllBundle\Entity\Usuario 
     */
    public function getEmisor()
    {
        return $this->emisor;
    }

    /**
     * Set receta
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $receta
     * @return RecetaCompartida
     */
    public function setReceta(\Concurso\Menus4AllBundle\Entity\Receta $receta = null)
    {
        $this->receta = $receta;
    
        return $this;
    }

    /**
     * Get receta
     *
     * @return Concurso\Menus4AllBundle\Entity\Receta 
     */
    public function getReceta()
    {
        return $this->receta;
    }
}