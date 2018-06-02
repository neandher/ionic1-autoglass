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
 *     "normalization_context"={"groups"={"tentativa"}},
 *     "denormalization_context"={"groups"={"tentativa"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\TentativaRepository")
 */
class Tentativa
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
    private $dicaAcionada = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $eliminarAcionado = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $pularAcionado = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $dobrarAcionado = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"tentativa"})
     */
    private $desafioAcionado = false;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Groups({"tentativa"})
     */
    private $pontuacao;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"tentativa"})
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @var Questionario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Questionario")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"tentativa"})
     * @Assert\NotNull()
     */
    private $questionario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TentativaResposta", mappedBy="tentativa", cascade={"persist"})
     * @Groups({"tentativa"})
     * @ApiSubresource()
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

    /**
     * @return bool
     */
    public function isDicaAcionada(): bool
    {
        return $this->dicaAcionada;
    }

    /**
     * @param bool $dicaAcionada
     * @return Tentativa
     */
    public function setDicaAcionada(bool $dicaAcionada): Tentativa
    {
        $this->dicaAcionada = $dicaAcionada;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEliminarAcionado(): bool
    {
        return $this->eliminarAcionado;
    }

    /**
     * @param bool $eliminarAcionado
     * @return Tentativa
     */
    public function setEliminarAcionado(bool $eliminarAcionado): Tentativa
    {
        $this->eliminarAcionado = $eliminarAcionado;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPularAcionado(): bool
    {
        return $this->pularAcionado;
    }

    /**
     * @param bool $pularAcionado
     * @return Tentativa
     */
    public function setPularAcionado(bool $pularAcionado): Tentativa
    {
        $this->pularAcionado = $pularAcionado;
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
     * @return Tentativa
     */
    public function setDobrarAcionado(bool $dobrarAcionado): Tentativa
    {
        $this->dobrarAcionado = $dobrarAcionado;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDesafioAcionado(): bool
    {
        return $this->desafioAcionado;
    }

    /**
     * @param bool $desafioAcionado
     * @return Tentativa
     */
    public function setDesafioAcionado(bool $desafioAcionado): Tentativa
    {
        $this->desafioAcionado = $desafioAcionado;
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
     * @return Tentativa
     */
    public function setPontuacao(int $pontuacao): Tentativa
    {
        $this->pontuacao = $pontuacao;
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
