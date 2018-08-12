<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MesaRepository")
 */
class Mesa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(name="cuenta", type="decimal", scale=2)
     */
    private $cuenta;

    /**
     * @ORM\OneToMany(targetEntity="Comanda", mappedBy="mesa", cascade="persist")
     *
     */
    private $comandas;
    public function __construct()
    {
        $this->comandas = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }
    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * @param mixed $cuenta
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta=$cuenta;
    }


    /**
     * @return mixed
     */
    public function getComandas()
    {
        return $this->comandas;
    }

    /**
     * @param mixed $comandas
     */

    public function setComandas($comandas)
    {
        $this->comandas = $comandas;
    }

    public function calculaPrecio()
    {
        $cuenta = 0;
        foreach($this->comandas as $comanda) {
            if ($comanda->getEstado() == 'Servida') {
                $cuenta=$cuenta + $comanda->calculaCuenta();
            }
        }
        $this->comandas = [];
        $this->cuenta = $cuenta;
        return $cuenta;
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
     * @return $this
     *
     */

    public function removeComandas()
    {
       $this->getComandas()->clear();
       return $this;
    }


    public function __toString()
    {
        return $this->getNumero();
    }
}
