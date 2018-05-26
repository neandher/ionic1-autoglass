<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
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
     * @Groups({"pergunta"})
     */
    private $id;

    /**
     * @var Pergunta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pergunta", inversedBy="perguntaRespostas")
     * @Groups({"pergunta"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $pergunta;

    /**
     * @var Resposta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Resposta")
     * @Groups({"pergunta"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $resposta;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10)
     * @Groups({"pergunta"})
     */
    private $letra;

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
     * @return string
     */
    public function getLetra(): string
    {
        return $this->letra;
    }

    /**
     * @param string $letra
     * @return PerguntaResposta
     */
    public function setLetra(string $letra): PerguntaResposta
    {
        $this->letra = $letra;
        return $this;
    }
}