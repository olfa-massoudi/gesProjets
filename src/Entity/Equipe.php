<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $description;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $responsalbe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $membre1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $membre2;

   /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $membre3;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

   

    
  
    
    public function getResponsalbe(): ?User
    {
        return $this->responsalbe;
    }

    public function setResponsalbe(?User $responsalbe): self
    {
        $this->responsalbe = $responsalbe;

        return $this;
    }

    public function getMembre1(): ?User
    {
        return $this->membre1;
    }

    public function setMembre1(?User $membre1): self
    {
        $this->membre1 = $membre1;

        return $this;
    }
    public function getMembre2(): ?User
    {
        return $this->membre1;
    }

    public function setMembre2(?User $membre1): self
    {
        $this->membre1 = $membre1;

        return $this;
    }
    public function getMembre3(): ?User
    {
        return $this->membre1;
    }

    public function setMembre3(?User $membre1): self
    {
        $this->membre1 = $membre1;

        return $this;
    }
}
