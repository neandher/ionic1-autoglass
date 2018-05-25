<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="pergunta_resposta")
 */
class PerguntaResposta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Pergunta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="perguntaRespostas")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $pergunta;

    /**
     * @var Resposta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $resposta;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $correta = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return PerguntaResposta
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Pergunta
     */
    public function getPergunta(): Pergunta
    {
        return $this->pergunta;
    }

    /**
     * @param Pergunta $pergunta
     * @return PerguntaResposta
     */
    public function setPergunta(Pergunta $pergunta): PerguntaResposta
    {
        $this->pergunta = $pergunta;
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
     * @return PerguntaResposta
     */
    public function setResposta(Resposta $resposta): PerguntaResposta
    {
        $this->resposta = $resposta;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCorreta(): bool
    {
        return $this->correta;
    }

    /**
     * @param bool $correta
     * @return PerguntaResposta
     */
    public function setCorreta(bool $correta): PerguntaResposta
    {
        $this->correta = $correta;
        return $this;
    }
}