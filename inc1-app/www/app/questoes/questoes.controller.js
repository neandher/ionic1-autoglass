(function () {
  function QuestoesController($stateParams, QuestionariosService) {
    var vm = this;
    var codigoQuestionario = $stateParams.codigo;
    vm.questionario = {};
    vm.questoes = [];
    vm.indice = 0;
    vm.questaoCorrente = {};
    vm.proxima = proxima;

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
        })
    }

    function proxima() {
      vm.indice++;
      vm.questaoCorrente = vm.questoes[vm.indice];
    }

    function anterior() {
      vm.indice--;
      vm.questaoCorrente = vm.questoes[vm.indice];
    }
  }

  angular.module('questionarioApp')
    .controller('QuestoesController', QuestoesController);
})();
