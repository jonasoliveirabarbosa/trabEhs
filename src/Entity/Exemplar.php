<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExemplarRepository")
 */
class Exemplar
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
    private $edicao;

    /**
     * @ORM\Column(type="integer")
     */
    private $ano;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $livre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Livro", inversedBy="exemplares")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emprestimo", mappedBy="exemplar")
     */
    private $emprestimos;

    public function __construct()
    {
        $this->emprestimos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEdicao(): ?string
    {
        return $this->edicao;
    }

    public function setEdicao(string $edicao): self
    {
        $this->edicao = $edicao;

        return $this;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(int $ano): self
    {
        $this->ano = $ano;

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

    public function getLivre(): ?bool
    {
        return $this->livre;
    }

    public function setLivre(bool $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getLivro(): ?Livro
    {
        return $this->livro;
    }

    public function setLivro(?Livro $livro): self
    {
        $this->livro = $livro;

        return $this;
    }

    /**
     * @return Collection|Emprestimo[]
     */
    public function getEmprestimos(): Collection
    {
        return $this->emprestimos;
    }

    public function addEmprestimo(Emprestimo $emprestimo): self
    {
        if (!$this->emprestimos->contains($emprestimo)) {
            $this->emprestimos[] = $emprestimo;
            $emprestimo->setExemplar($this);
        }

        return $this;
    }

    public function removeEmprestimo(Emprestimo $emprestimo): self
    {
        if ($this->emprestimos->contains($emprestimo)) {
            $this->emprestimos->removeElement($emprestimo);
            // set the owning side to null (unless already changed)
            if ($emprestimo->getExemplar() === $this) {
                $emprestimo->setExemplar(null);
            }
        }

        return $this;
    }
}
