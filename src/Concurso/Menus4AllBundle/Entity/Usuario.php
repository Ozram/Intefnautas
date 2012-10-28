<?php

namespace Concurso\Menus4AllBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Concurso\Menus4AllBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Concurso\Menus4AllBundle\Entity\UsuarioRepository")
 */
class Usuario extends BaseUser {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $apellidos
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\OneToMany(targetEntity="Receta", mappedBy="usuario")
     */
    private $recetas;

    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="usuario")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="ValoracionMenu", mappedBy="usuario")
     */
    private $valoracionMenu;

    /**
     * @ORM\OneToMany(targetEntity="ValoracionReceta", mappedBy="usuario")
     */
    private $valoracionReceta;

    /**
     * @ORM\OneToMany(targetEntity="ListaCompra", mappedBy="usuario")
     */
    private $listasCompra;

    /**
     * @ORM\OneToMany(targetEntity="RecetaCompartida", mappedBy="receptor")
     */
    private $recetasCompartidasConUsuario;

    /**
     * @ORM\OneToMany(targetEntity="RecetaCompartida", mappedBy="emisor")
     */
    private $recetasCompartidasPorUsuario;
    
    /**
     * @ORM\OneToMany(targetEntity="MenuCompartido", mappedBy="receptor")
     */
    private $menusCompartidasConUsuario;

    /**
     * @ORM\OneToMany(targetEntity="MenuCompartido", mappedBy="emisor")
     */
    private $menusCompartidasPorUsuario;

    public function __construct() {
        parent::__construct();
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

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
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
     * Set apellidos
     *
     * @param string $apellidos
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Add recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     * @return Usuario
     */
    public function addReceta(\Concurso\Menus4AllBundle\Entity\Receta $recetas) {
        $this->recetas[] = $recetas;

        return $this;
    }

    /**
     * Remove recetas
     *
     * @param Concurso\Menus4AllBundle\Entity\Receta $recetas
     */
    public function removeReceta(\Concurso\Menus4AllBundle\Entity\Receta $recetas) {
        $this->recetas->removeElement($recetas);
    }

    /**
     * Get recetas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecetas() {
        return $this->recetas;
    }

    /**
     * Add menus
     *
     * @param Concurso\Menus4AllBundle\Entity\Menu $menus
     * @return Usuario
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
     * Add listasCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra
     * @return Usuario
     */
    public function addListasCompra(\Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra) {
        $this->listasCompra[] = $listasCompra;

        return $this;
    }

    /**
     * Remove listasCompra
     *
     * @param Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra
     */
    public function removeListasCompra(\Concurso\Menus4AllBundle\Entity\ListaCompra $listasCompra) {
        $this->listasCompra->removeElement($listasCompra);
    }

    /**
     * Get listasCompra
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListasCompra() {
        return $this->listasCompra;
    }

    /**
     * Add valoracionMenu
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionMenu $valoracionMenu
     * @return Usuario
     */
    public function addValoracionMenu(\Concurso\Menus4AllBundle\Entity\ValoracionMenu $valoracionMenu) {
        $this->valoracionMenu[] = $valoracionMenu;

        return $this;
    }

    /**
     * Remove valoracionMenu
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionMenu $valoracionMenu
     */
    public function removeValoracionMenu(\Concurso\Menus4AllBundle\Entity\ValoracionMenu $valoracionMenu) {
        $this->valoracionMenu->removeElement($valoracionMenu);
    }

    /**
     * Get valoracionMenu
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getValoracionMenu() {
        return $this->valoracionMenu;
    }

    /**
     * Add valoracionReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoracionReceta
     * @return Usuario
     */
    public function addValoracionReceta(\Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoracionReceta) {
        $this->valoracionReceta[] = $valoracionReceta;

        return $this;
    }

    /**
     * Remove valoracionReceta
     *
     * @param Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoracionReceta
     */
    public function removeValoracionReceta(\Concurso\Menus4AllBundle\Entity\ValoracionReceta $valoracionReceta) {
        $this->valoracionReceta->removeElement($valoracionReceta);
    }

    /**
     * Get valoracionReceta
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getValoracionReceta() {
        return $this->valoracionReceta;
    }


    /**
     * Add recetasCompartidasConUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasConUsuario
     * @return Usuario
     */
    public function addRecetasCompartidasConUsuario(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasConUsuario)
    {
        $this->recetasCompartidasConUsuario[] = $recetasCompartidasConUsuario;
    
        return $this;
    }

    /**
     * Remove recetasCompartidasConUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasConUsuario
     */
    public function removeRecetasCompartidasConUsuario(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasConUsuario)
    {
        $this->recetasCompartidasConUsuario->removeElement($recetasCompartidasConUsuario);
    }

    /**
     * Get recetasCompartidasConUsuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecetasCompartidasConUsuario()
    {
        return $this->recetasCompartidasConUsuario;
    }

    /**
     * Add recetasCompartidasPorUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasPorUsuario
     * @return Usuario
     */
    public function addRecetasCompartidasPorUsuario(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasPorUsuario)
    {
        $this->recetasCompartidasPorUsuario[] = $recetasCompartidasPorUsuario;
    
        return $this;
    }

    /**
     * Remove recetasCompartidasPorUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasPorUsuario
     */
    public function removeRecetasCompartidasPorUsuario(\Concurso\Menus4AllBundle\Entity\RecetaCompartida $recetasCompartidasPorUsuario)
    {
        $this->recetasCompartidasPorUsuario->removeElement($recetasCompartidasPorUsuario);
    }

    /**
     * Get recetasCompartidasPorUsuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecetasCompartidasPorUsuario()
    {
        return $this->recetasCompartidasPorUsuario;
    }

    /**
     * Add menusCompartidasConUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasConUsuario
     * @return Usuario
     */
    public function addMenusCompartidasConUsuario(\Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasConUsuario)
    {
        $this->menusCompartidasConUsuario[] = $menusCompartidasConUsuario;
    
        return $this;
    }

    /**
     * Remove menusCompartidasConUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasConUsuario
     */
    public function removeMenusCompartidasConUsuario(\Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasConUsuario)
    {
        $this->menusCompartidasConUsuario->removeElement($menusCompartidasConUsuario);
    }

    /**
     * Get menusCompartidasConUsuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMenusCompartidasConUsuario()
    {
        return $this->menusCompartidasConUsuario;
    }

    /**
     * Add menusCompartidasPorUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasPorUsuario
     * @return Usuario
     */
    public function addMenusCompartidasPorUsuario(\Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasPorUsuario)
    {
        $this->menusCompartidasPorUsuario[] = $menusCompartidasPorUsuario;
    
        return $this;
    }

    /**
     * Remove menusCompartidasPorUsuario
     *
     * @param Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasPorUsuario
     */
    public function removeMenusCompartidasPorUsuario(\Concurso\Menus4AllBundle\Entity\MenuCompartido $menusCompartidasPorUsuario)
    {
        $this->menusCompartidasPorUsuario->removeElement($menusCompartidasPorUsuario);
    }

    /**
     * Get menusCompartidasPorUsuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMenusCompartidasPorUsuario()
    {
        return $this->menusCompartidasPorUsuario;
    }
}