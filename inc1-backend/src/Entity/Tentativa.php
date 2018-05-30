<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TentativaRepository")
 */
class Tentativa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\NotNull()
     */
    private $tempoInicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $tempoFim;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @var Questionario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Questionario")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $questionario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TentativaResposta", mappedBy="tentativa", fetch="EXTRA_LAZY")
     */
    private $tentativaRespostas;

    public function __construct()
    {
        $this->tentativaRespostas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTempoInicio(): ?\DateTimeInterface
    {
        return $this->tempoInicio;
    }

    public function setTempoInicio(\DateTimeInterface $tempoInicio): self
    {
        $this->tempoInicio = $tempoInicio;

        return $this;
    }

    public function getTempoFim(): ?\DateTimeInterface
    {
        return $this->tempoFim;
    }

    public function setTempoFim(?\DateTimeInterface $tempoFim): self
    {
        $this->tempoFim = $tempoFim;

        return $this;
    }

    /**
     * @return Collection|TentativaResposta[]
     */
    public function getTentativaRespostas(): Collection
    {
        return $this->tentativaRespostas;
    }

    public function addTentativaResposta(TentativaResposta $tentativaResposta): self
    {
        if (!$this->tentativaRespostas->contains($tentativaResposta)) {
            $this->tentativaRespostas[] = $tentativaResposta;
            $tentativaResposta->setTentativa($this);
        }

        return $this;
    }

    public function removeTentativaResposta(TentativaResposta $tentativaResposta): self
    {
        if ($this->tentativaRespostas->contains($tentativaResposta)) {
            $this->tentativaRespostas->removeElement($tentativaResposta);
            // set the owning side to null (unless already changed)
            if ($tentativaResposta->getTentativa() === $this) {
                $tentativaResposta->setTentativa(null);
            }
        }

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Tentativa
     */
    public function setUser(User $user): Tentativa
    {
        $this->user = $user;
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
     * @return Tentativa
     */
    public function setQuestionario(Questionario $questionario): Tentativa
    {
        $this->questionario = $questionario;
        return $this;
    }
}
