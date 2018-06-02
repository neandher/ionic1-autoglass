<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"pergunta"}},
 *     "denormalization_context"={"groups"={"pergunta"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PerguntaRepository")
 */
class Pergunta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"pergunta", "tentativa"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pergunta", "tentativa"})
     * @Assert\NotBlank()
     */
    private $descricao;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Groups({"pergunta"})
     * @Assert\NotBlank()
     */
    private $pontuacao;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"pergunta"})
     * @Assert\NotBlank()
     */
    private $dica;

    /**
     * @var PerguntaResposta
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PerguntaResposta", mappedBy="pergunta", cascade={"persist"})
     * @Groups({"pergunta"})
     * @Assert\Count(min="1")
     */
    private $perguntaRespostas;

    /**
     * @var Questionario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Questionario", inversedBy="perguntas")
     * @Groups({"pergunta"})
     * @Assert\NotNull()
     */
    private $questionario;

    /**
     * @var Resposta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @Groups({"pergunta"})
     * @Assert\NotNull()
     */
    private $resposta;

    /**
     * Pergunta constructor.
     */
    public function __construct()
    {
        $this->perguntaRespostas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection|PerguntaResposta[]
     */
    public function getPerguntaRespostas(): Collection
    {
        return $this->perguntaRespostas;
    }

    public function addPerguntaResposta(PerguntaResposta $perguntaResposta): self
    {
        if (!$this->perguntaRespostas->contains($perguntaResposta)) {
            $this->perguntaRespostas[] = $perguntaResposta;
            $perguntaResposta->setPergunta($this);
        }

        return $this;
    }

    public function removePerguntaResposta(PerguntaResposta $perguntaResposta): self
    {
        if ($this->perguntaRespostas->contains($perguntaResposta)) {
            $this->perguntaRespostas->removeElement($perguntaResposta);
            // set the owning side to null (unless already changed)
            if ($perguntaResposta->getPergunta() === $this) {
                $perguntaResposta->setPergunta(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getPontuacao(): int
    {
        return $this->pontuacao;
    }

    /**
     * @param int $pontuacao
     * @return Pergunta
     */
    public function setPontuacao(int $pontuacao): Pergunta
    {
        $this->pontuacao = $pontuacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getDica(): string
    {
        return $this->dica;
    }

    /**
     * @param string $dica
     * @return Pergunta
     */
    public function setDica(string $dica): Pergunta
    {
        $this->dica = $dica;
        return $this;
    }

    /**
     * @return Questionario
     */
    public function getQuestionario(): Questionario
    {
        return $this->questionario;
    }

    /**
     * @param Questionario $questionario
     * @return Pergunta
     */
    public function setQuestionario(Questionario $questionario): Pergunta
    {
        $this->questionario = $questionario;
        return $this;
    }

    /**
     * @return Resposta
     */
    public function getResposta(): Resposta
    {
        return $this->resposta;
    }

    /**
     * @param Resposta $resposta
     * @return Pergunta
     */
    public function setResposta(Resposta $resposta): Pergunta
    {
        $this->resposta = $resposta;
        return $this;
    }

}
