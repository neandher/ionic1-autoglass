<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TentativaRespostaRepository")
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 *     )
 */
class TentativaResposta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"tentativa"})
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $respondida = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $acertou = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $pulou = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $usouDica = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tentativa", inversedBy="tentativaRespostas")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\NotNull()
     */
    private $tentativa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"tentativa"})
     * @Assert\NotNull()
     */
    private $pergunta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @Groups({"tentativa"})
     */
    private $resposta;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isRespondida(): bool
    {
        return $this->respondida;
    }

    /**
     * @param bool $respondida
     * @return TentativaResposta
     */
    public function setRespondida(bool $respondida): TentativaResposta
    {
        $this->respondida = $respondida;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAcertou(): bool
    {
        return $this->acertou;
    }

    /**
     * @param bool $acertou
     * @return TentativaResposta
     */
    public function setAcertou(bool $acertou): TentativaResposta
    {
        $this->acertou = $acertou;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPulou(): bool
    {
        return $this->pulou;
    }

    /**
     * @param bool $pulou
     * @return TentativaResposta
     */
    public function setPulou(bool $pulou): TentativaResposta
    {
        $this->pulou = $pulou;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUsouDica(): bool
    {
        return $this->usouDica;
    }

    /**
     * @param bool $usouDica
     * @return TentativaResposta
     */
    public function setUsouDica(bool $usouDica): TentativaResposta
    {
        $this->usouDica = $usouDica;
        return $this;
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
