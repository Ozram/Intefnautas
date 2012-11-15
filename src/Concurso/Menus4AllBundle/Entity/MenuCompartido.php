<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Concurso\Menus4AllBundle\Entity\MenuCompartido
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="menuCompartidoUnico", columns={"receptor_id", "emisor_id", "menu_id"})})
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\MenuCompartidoRepository")
 */
class MenuCompartido
{
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
     * @var boolean $visitado
     *
     * @ORM\Column(name="visitado", type="boolean")
     */
    private $visitado;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="menusCompartidasConUsuario")
     */
    private $receptor;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="menusCompartidasPorUsuario")
     */
    private $emisor;
    
    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menusCompartidos")
     */
    private $menu;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return MenuCompartido
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    
        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set visitado
     *
     * @param boolean $visitado
     * @return MenuCompartido
     */
    public function setVisitado($visitado)
    {
        $this->visitado = $visitado;
    
        return $this;
    }

    /**
     * Get visitado
     *
     * @return boolean 
     */
    public function getVisitado()
    {
        return $this->visitado;
    }

    /**
     * Set receptor
     *
     * @param Concurso\Menus4AllBundle\Entity\Usuario $receptor
     * @return MenuCompartido
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
     * @return MenuCompartido
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
     * Set menu
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menu
     * @return MenuCompartido
     */
    public function setMenu(\Concurso\Menus4AllBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return Concurso\Menus4AllBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }
}