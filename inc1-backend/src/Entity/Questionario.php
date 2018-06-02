<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"questionario"}},
 *     "denormalization_context"={"groups"={"questionario"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\QuestionarioRepository")
 */
class Questionario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"questionario","pergunta", "tentativa"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"questionario","pergunta", "tentativa"})
     */
    private $descricao;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"questionario"})
     */
    private $pontuacaoTotal;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"questionario"})
     */
    private $tempo;

    /**
     * @var Pergunta
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Pergunta", mappedBy="questionario")
     * @Groups({"questionario"})
     * @ApiSubresource()
     */
    private $perguntas;

    /**
     * Questionario constructor.
     */
    public function __construct()
    {
        $this->perguntas = new ArrayCollection();
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

    public function getPontuacaoTotal(): ?int
    {
        return $this->pontuacaoTotal;
    }

    public function setPontuacaoTotal(int $pontuacaoTotal): self
    {
        $this->pontuacaoTotal = $pontuacaoTotal;

        return $this;
    }

    public function getTempo(): ?int
    {
        return $this->tempo;
    }

    public function setTempo(int $tempo): self
    {
        $this->tempo = $tempo;

        return $this;
    }

    /**
     * @return Collection|Pergunta[]
     */
    public function getPerguntas(): Collection
    {
        return $this->perguntas;
    }

    public function addPergunta(Pergunta $pergunta): self
    {
        if (!$this->perguntas->contains($pergunta)) {
            $this->perguntas[] = $pergunta;
            $pergunta->setQuestionario($this);
        }

        return $this;
    }

    public function removePergunta(Pergunta $pergunta): self
    {
        if ($this->perguntas->contains($pergunta)) {
            $this->perguntas->removeElement($pergunta);
            // set the owning side to null (unless already changed)
            if ($pergunta->getQuestionario() === $this) {
                $pergunta->setQuestionario(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isDobrarAcionado(): bool
    {
        return $this->dobrarAcionado;
    }

    /**
     * @param bool $dobrarAcionado
     * @return Questionario
     */
    public function setDobrarAcionado(bool $dobrarAcionado): Questionario
    {
        $this->dobrarAcionado = $dobrarAcionado;
        return $this;
    }
}
