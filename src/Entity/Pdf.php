<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PdfRepository")
 */
class Pdf extends File
{
   
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

  

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }
}
