(function () {
  function QuestoesController($stateParams, QuestionariosService, MensagemService, $ionicScrollDelegate, AppConstants,
                              TentativasService) {
    let vm = this;
    let codigoQuestionario = $stateParams.codigo;
    vm.questionario = {};
    vm.questoes = [];
    vm.questaoCorrente = {};
    vm.indice = 0;
    vm.pontuacaoCorrente = 0;
    vm.opcaoCorrente = 0;
    vm.verificaProxima = false;
    vm.verificaAnterior = false;
    vm.verificaUltima = false;
    vm.tentativa = {};
    vm.tentativaRespostas = [];
    vm.tentativaRespostaCorrente = {};

    vm.irProxima = irProxima;
    vm.irAnterior = irAnterior;
    vm.responder = responder;
    vm.dica = dica;
    vm.eliminar = eliminar;
    vm.pular = pular;
    vm.dobrar = dobrar;
    vm.finalizar = finalizar;

    //ao iniciar
    recuperarQuestionarioDetalhe();
    recuperarQuestoes();

    //funcoes
    function recuperarQuestionarioDetalhe() {
      QuestionariosService.recuperarDetalhe(codigoQuestionario)
        .then(function () {
          vm.questionario = QuestionariosService.questionario;
        })
    }

    function recuperarQuestoes() {
      QuestionariosService.recuperarQuestoes(codigoQuestionario)
        .then(function () {
          vm.questoes = QuestionariosService.questoes;
          vm.questaoCorrente = vm.questoes[vm.indice];
          iniciaTentativa();
          verificaNavegacao();
        })
    }

    function iniciaTentativa() {
      vm.tentativa = {
        "dicaAcionada": false,
        "eliminarAcionado": false,
        "pularAcionado": false,
        "dobrarAcionado": false,
        "desafioAcionado": false,
        "pontuacao": 0,
        "user": '/api/users/' + AppConstants.userId,
        "questionario": '/api/questionarios/' + vm.questaoCorrente.questionario.id,
        "tentativaRespostas": [],
      };
      vm.questoes.forEach(function () {
        vm.tentativaRespostas.push({
          "respondida": false,
          "acertou": false,
          "pulou": false,
          "usouDica": false,
          "pergunta": '/api/perguntas/' + vm.questaoCorrente.id,
          "resposta": null
        });
      });
      vm.tentativaRespostaCorrente = vm.tentativaRespostas[vm.indice];
    }

    function irProxima() {
      $ionicScrollDelegate.scrollTop(true);
      vm.indice++;
      vm.questaoCorrente = vm.questoes[vm.indice];
      vm.tentativaRespostaCorrente = vm.tentativaRespostas[vm.indice];
      verificaNavegacao();
    }

    function irAnterior() {
      $ionicScrollDelegate.scrollTop(true);
      vm.indice--;
      vm.questaoCorrente = vm.questoes[vm.indice];
      vm.tentativaRespostaCorrente = vm.tentativaRespostas[vm.indice];
      verificaNavegacao();
    }

    function verificaNavegacao() {
      //vm.verificaProxima = (vm.questoes.length - 1) - vm.indice > 0 && (vm.questaoCorrente.respondida || vm.questaoCorrente.pulou);
      vm.verificaProxima = (vm.questoes.length - 1) - vm.indice > 0 && (vm.tentativaRespostaCorrente.respondida || vm.tentativaRespostaCorrente.pulou);
      vm.verificaAnterior = vm.indice > 0;
      vm.verificaUltima = (vm.questoes.length - 1) === vm.indice;
      vm.opcaoCorrente = 0;
    }

    function responder() {
      if (!vm.opcaoCorrente) {
        MensagemService.informacao('Selecione uma das opções de resposta');
      }
      else {
        vm.tentativaRespostaCorrente.respondida = true;
        vm.tentativaRespostaCorrente.resposta = '/api/respostas/' + vm.opcaoCorrente;
        vm.tentativaRespostaCorrente.acertou = parseInt(vm.opcaoCorrente) === vm.questaoCorrente.resposta.id;
        if (vm.tentativaRespostaCorrente.acertou) {
          vm.pontuacaoCorrente += vm.questaoCorrente.pontuacao;
          MensagemService.sucesso("Parabéns", "Você acertou");
        }
        else {
          vm.pontuacaoCorrente -= vm.questaoCorrente.pontuacao * 2;
          MensagemService.erro("Que Pena", "Você errou");
        }
        verificaNavegacao();
      }
    }

    function dica() {
      vm.tentativa.dicaAcionada = true;
      vm.tentativaRespostaCorrente.usouDica = true;
    }

    function eliminar() {
      vm.tentativa.eliminarAcionado = true;
      let eliminarCount = 0;
      vm.questaoCorrente.perguntaRespostas = vm.questaoCorrente.perguntaRespostas.filter(function (opcao) {
        if (opcao.resposta.id === vm.questaoCorrente.resposta.id) {
          return opcao;
        }
        if (eliminarCount >= 2) {
          return opcao;
        }
        eliminarCount++;
      });
      $ionicScrollDelegate.scrollTop(true);
    }

    function pular() {
      vm.tentativa.pularAcionado = true;
      vm.tentativaRespostaCorrente.pulou = true;
      if ((vm.questoes.length - 1) - vm.indice > 0) {
        irProxima();
      }
    }

    function dobrar() {
      vm.tentativa.dobrarAcionado = true;
      vm.questaoCorrente.pontuacao = vm.questaoCorrente.pontuacao * 2;
    }

    function finalizar() {
      vm.tentativa.pontuacao = vm.pontuacaoCorrente;
      vm.tentativa.tentativaRespostas = vm.tentativaRespostas;
      TentativasService.inserir(vm.tentativa)
        .then(function (resposta) {
          MensagemService.sucesso("Finalizado", "Questionário finalizado com sucesso!");
        }, function (resposta) {
          MensagemService.erro("Ops!", "Houve um erro ao finalizar o questionário");
          console.log(resposta);
        })
    }
  }

  angular.module('questionarioApp')
    .controller('QuestoesController', QuestoesController);
})();
