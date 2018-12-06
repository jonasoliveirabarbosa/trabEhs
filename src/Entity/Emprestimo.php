<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmprestimoRepository")
 */
class Emprestimo
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
    private $inicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fim;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="emprestimo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exemplar", inversedBy="emprestimos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exemplar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInicio(): ?\DateTimeInterface
    {
        return $this->inicio;
    }

    public function setInicio(\DateTimeInterface $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFim(): ?\DateTimeInterface
    {
        return $this->fim;
    }

    public function setFim(\DateTimeInterface $fim): self
    {
        $this->fim = $fim;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getExemplar(): ?Exemplar
    {
        return $this->exemplar;
    }

    public function setExemplar(?Exemplar $exemplar): self
    {
        $this->exemplar = $exemplar;

        return $this;
    }

    public function __toString()
    {
        return $this->exemplar->getNome().' '. $this->inicio->format('d/m/Y H:i:s') .' '. $this->fim->format('d/m/Y H:i:s');
    }
}
