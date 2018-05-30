(function () {
  function QuestoesController($stateParams, QuestionariosService, MensagemService, $ionicScrollDelegate) {
    let vm = this;
    let codigoQuestionario = $stateParams.codigo;
    vm.questionario = {};
    vm.questoes = [];
    vm.indice = 0;
    vm.questaoCorrente = {};
    vm.pontuacaoCorrente = 0;
    vm.opcaoCorrente = 0;
    vm.verificaProxima = false;
    vm.verificaAnterior = false;
    vm.verificaUltima = false;
    vm.tentativas = [];

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
          verificaNavegacao();
        })
    }

    function irProxima() {
      $ionicScrollDelegate.scrollTop();
      vm.indice++;
      vm.questaoCorrente = vm.questoes[vm.indice];
      verificaNavegacao();
    }

    function irAnterior() {
      $ionicScrollDelegate.scrollTop();
      vm.indice--;
      vm.questaoCorrente = vm.questoes[vm.indice];
      verificaNavegacao();
    }

    function verificaNavegacao() {
      vm.verificaProxima = (vm.questoes.length - 1) - vm.indice > 0 && vm.questaoCorrente.respondida;
      vm.verificaAnterior = vm.indice > 0;
      vm.verificaUltima = (vm.questoes.length - 1) === vm.indice;
      vm.opcaoCorrente = 0;
    }

    function responder() {
      if (!vm.opcaoCorrente) {
        MensagemService.informacao('Selecione uma das opções de resposta');
      }
      else {
        vm.questaoCorrente.respondida = true;
        vm.questaoCorrente.acertou = parseInt(vm.opcaoCorrente) === vm.questaoCorrente.resposta.id;
        if (vm.questaoCorrente.acertou) {
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
      vm.questionario.dicaAcionada = true;
      vm.questaoCorrente.usouDica = true;
    }

    function eliminar() {
      // MensagemService.aviso(function (result) {
      //   if (result) {
      vm.questionario.eliminarAcionado = true;
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
      $ionicScrollDelegate.scrollTop();
      // }
      //});
    }

    function pular() {
      // MensagemService.aviso(function (result) {
      //   if (result) {
      vm.questionario.pularAcionado = true;
      vm.questaoCorrente.pulou = true;
      //   }
      // });
    }

    function dobrar() {
      // MensagemService.aviso(function (result) {
      //   if (result === true) {
      vm.questionario.dobrarAcionado = true;
      vm.questaoCorrente.pontuacao = vm.questaoCorrente.pontuacao * 2;
      //   }
      // });
    }

    function finalizar() {
      console.log('finalizar');
      // MensagemService.aviso(function (result) {
      //   if (result) {
          console.log('finalizado');
      //   }
      // });
    }
  }

  angular.module('questionarioApp')
    .controller('QuestoesController', QuestoesController);
})();
