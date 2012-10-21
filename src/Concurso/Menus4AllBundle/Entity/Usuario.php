<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concurso\Menus4AllBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\UsuarioRepository")
 */
class Usuario {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Receta", mappedBy="usuario")
     */
    private $recetas;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="usuario")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="ListaCompra", mappedBy="usuario")
     */
    private $listasCompra;

    public function __construct() {
        $this->recetas = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

}
