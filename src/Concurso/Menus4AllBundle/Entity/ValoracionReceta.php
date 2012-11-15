<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\ValoracionReceta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\ValoracionRecetaRepository")
 */
class ValoracionReceta {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $puntuacion
     *
     * @ORM\Column(name="puntuacion", type="integer")
     */
    private $puntuacion;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="comentario", type="text")
     */
    private $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="valoraciones")
     */
    private $receta;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="valoracionReceta")
     */
    private $usuario;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set puntuacion
     *
     * @param integer $puntuacion
     * @return ValoracionReceta
     */
    public function setPuntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Get puntuacion
     *
     * @return integer 
     */
    public function getPuntuacion() {
        return $this->puntuacion;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return ValoracionReceta
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * Set receta
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $receta
     * @return ValoracionReceta
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
     * Set usuario
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $usuario
     * @return ValoracionReceta
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
}