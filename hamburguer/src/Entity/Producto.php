<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     * @ORM\Column(name="nombre", type="text", length=60)
     */
    private $nombre;
    /**
     * @var float
     * @ORM\Column(name="precio", type="decimal", scale=2)
     */
    private $precio;
    /**
     * @var integer
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;
    /**
     * @var string
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Comanda", mappedBy="productos")
     */
    private $comandas;
    public function __construct()
    {
        $this->comandas = new ArrayCollection();
    }
    /**
     * @param Comanda $comanda
     * @return $this
     */
    public function addComanda(\App\Entity\Comanda $comanda)
    {
        $this->comandas[] = $comanda;
        return $this;
    }
    /**
     * @param Comanda $comanda
     */
    public function removeComanda(\App\Entity\Comanda $comanda)
    {
        $this->comandas->removeElement($comanda);
    }
    /**
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    /**
     * @param int $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo=$tipo;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return string
     *
     */
    public function __toString()
    {
        return $this->nombre;
    }
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre=$nombre;
    }
    /**
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }
    /**
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio=$precio;
    }
    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion=$descripcion;
    }
}