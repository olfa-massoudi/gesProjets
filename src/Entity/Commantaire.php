<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommantaireRepository")
 */
class Commantaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_comm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\tache")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tache;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $utlisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateComm(): ?\DateTimeInterface
    {
        return $this->date_comm;
    }

    public function setDateComm(\DateTimeInterface $date_comm): self
    {
        $this->date_comm = $date_comm;

        return $this;
    }

    public function getTache(): ?tache
    {
        return $this->tache;
    }

    public function setTache(?tache $tache): self
    {
        $this->tache = $tache;

        return $this;
    }

    public function getUtlisateur(): ?string
    {
        return $this->utlisateur;
    }

    public function setUtlisateur(string $utlisateur): self
    {
        $this->utlisateur = $utlisateur;

        return $this;
    }
}
