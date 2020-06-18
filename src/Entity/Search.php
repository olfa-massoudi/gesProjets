<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SearchRepository")
 */
class Search
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
    private $data;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $filtre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getFiltre(): ?string
    {
        return $this->filtre;
    }

    public function setFiltre(?string $filtre): self
    {
        $this->filtre = $filtre;

        return $this;
    }
}
