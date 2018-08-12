<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ComandaRepository")
 */
class Comanda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     * @ORM\Column(name="estado", type="text")
     */
    private $estado;

    /**
     *@ORM\ManyToOne(targetEntity="Mesa", inversedBy="comandas")
     */

    private $mesa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Camarero", inversedBy="comandas")
     */
    private $camarero;

    /**
     * @ORM\Column(name="precio", type="decimal", scale=2, nullable=true)
     */
    private $precio;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Producto", inversedBy="comandas", cascade="persist")
     */
    private $productos;

    private $prod1;
    private $prod2;
    private $prod3;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->estado = "En preparación";
    }
    /**
     * @return mixed
     */
    public function getProductos()
    {
        return $this->productos;
    }
    /**
     * @return int
     */
    public function getMesa()
    {
        return $this->mesa;
    }
    /**
     * @param int $mesa
     */
    public function setMesa($mesa)
    {
        $this->mesa=$mesa;
    }

    /**
     * @param Producto $producto
     * @return $this
     */
    public function addProducto(\App\Entity\Producto $producto)
    {
        $this->productos[] = $producto;
        return $this;
    }
    /**
     * @param Producto $producto
     */
    public function removeProducto(\App\Entity\Producto $producto)
    {
        $this->productos->removeElement($producto);
    }
    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado=$estado;
    }
    /**
     *@param Producto $producto
     */
    public function calculaCuenta()
    {
        $cuenta = 0;
        foreach($this->productos as $prod)
        {
            $cuenta = $cuenta + $prod->getPrecio();
        }
        $this->precio = $cuenta;
        return $cuenta;
    }
    /**
     * @return mixed
     */
    public function getProd1()
    {
        return $this->prod1;
    }
    /**
     * @param mixed $prod1
     */
    public function setProd1($prod1)
    {
        $this->prod1 = $prod1;
    }
    /**
     * @return mixed
     */
    public function getProd2()
    {
        return $this->prod2;
    }
    /**
     * @param mixed $prod2
     */
    public function setProd2($prod2)
    {
        $this->prod2 = $prod2;
    }
    /**
     * @return mixed
     */
    public function getProd3()
    {
        return $this->prod3;
    }
    /**
     * @param mixed $prod3
     */
    public function setProd3($prod3)
    {
        $this->prod3 = $prod3;
    }

    /**
     * @return mixed
     */
    public function getCamarero()
    {
        return $this->camarero;
    }

    /**
     * @param mixed $camarero
     */
    public function setCamarero($camarero)
    {
        $this->camarero=$camarero;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio=$precio;
    }


}