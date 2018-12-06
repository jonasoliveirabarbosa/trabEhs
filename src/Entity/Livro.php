<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivroRepository")
 */
class Livro
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
    private $genero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $editora;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exemplar", mappedBy="livro")
     */
    private $exemplares;

    public function __construct()
    {
        $this->exemplares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getEditora(): ?string
    {
        return $this->editora;
    }

    public function setEditora(?string $editora): self
    {
        $this->editora = $editora;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * @return Collection|Exemplar[]
     */
    public function getExemplares(): Collection
    {
        return $this->exemplares;
    }

    public function addExemplare(Exemplar $exemplare): self
    {
        if (!$this->exemplares->contains($exemplare)) {
            $this->exemplares[] = $exemplare;
            $exemplare->setLivro($this);
        }

        return $this;
    }

    public function removeExemplare(Exemplar $exemplare): self
    {
        if ($this->exemplares->contains($exemplare)) {
            $this->exemplares->removeElement($exemplare);
            // set the owning side to null (unless already changed)
            if ($exemplare->getLivro() === $this) {
                $exemplare->setLivro(null);
            }
        }

        return $this;
    }
}
