<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
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
    private $nome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emprestimo", mappedBy="cliente")
     */
    private $emprestimo;

    public function __construct()
    {
        $this->emprestimo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return Collection|Emprestimo[]
     */
    public function getEmprestimo(): Collection
    {
        return $this->emprestimo;
    }

    public function addEmprestimo(Emprestimo $emprestimo): self
    {
        if (!$this->emprestimo->contains($emprestimo)) {
            $this->emprestimo[] = $emprestimo;
            $emprestimo->setCliente($this);
        }

        return $this;
    }

    public function removeEmprestimo(Emprestimo $emprestimo): self
    {
        if ($this->emprestimo->contains($emprestimo)) {
            $this->emprestimo->removeElement($emprestimo);
            // set the owning side to null (unless already changed)
            if ($emprestimo->getCliente() === $this) {
                $emprestimo->setCliente(null);
            }
        }

        return $this;
    }
}
