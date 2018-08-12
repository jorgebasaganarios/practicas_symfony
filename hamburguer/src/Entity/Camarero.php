<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CamareroRepository")
 */
class Camarero
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     *  @ORM\OneToMany(targetEntity="App\Entity\Comanda", mappedBy="camarero", cascade={"remove"})
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

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComanda()
    {
        return $this->comandas;
    }

    /**
     * @param mixed $comanda
     */
    public function setComanda($comandas)
    {
        $this->comandas=$comandas;
    }

    public function __toString()
    {
        return $this->nombre;
    }

}
