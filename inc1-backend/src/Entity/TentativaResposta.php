<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TentativaRespostaRepository")
 */
class TentativaResposta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tentativa", inversedBy="tentativaRespostas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\NotNull()
     */
    private $tentativa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $pergunta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $resposta;

    public function getId()
    {
        return $this->id;
    }

    public function getTentativa(): ?Tentativa
    {
        return $this->tentativa;
    }

    public function setTentativa(?Tentativa $tentativa): self
    {
        $this->tentativa = $tentativa;

        return $this;
    }

    public function getPergunta(): ?Pergunta
    {
        return $this->pergunta;
    }

    public function setPergunta(?Pergunta $pergunta): self
    {
        $this->pergunta = $pergunta;

        return $this;
    }

    public function getResposta(): ?Resposta
    {
        return $this->resposta;
    }

    public function setResposta(?Resposta $resposta): self
    {
        $this->resposta = $resposta;

        return $this;
    }
}
