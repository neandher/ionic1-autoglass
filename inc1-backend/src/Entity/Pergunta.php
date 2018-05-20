<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PerguntaRepository")
 */
class Pergunta
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
    private $descricao;

    /**
     * @var PerguntaResposta
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PerguntaResposta", mappedBy="pergunta", fetch="EXTRA_LAZY")
     */
    private $perguntaRespostas;

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
}
