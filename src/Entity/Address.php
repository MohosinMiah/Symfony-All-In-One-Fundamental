<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStret(): ?string
    {
        return $this->stret;
    }

    public function setStret(string $stret): self
    {
        $this->stret = $stret;

        return $this;
    }
}
