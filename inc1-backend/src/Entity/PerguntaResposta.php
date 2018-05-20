<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var PerguntaResposta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="perguntaRespostas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pergunta;

    /**
     * @var Resposta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resposta;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $correta;

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
     * @return PerguntaResposta
     */
    public function getPergunta(): PerguntaResposta
    {
        return $this->pergunta;
    }

    /**
     * @param PerguntaResposta $pergunta
     * @return PerguntaResposta
     */
    public function setPergunta(PerguntaResposta $pergunta): PerguntaResposta
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