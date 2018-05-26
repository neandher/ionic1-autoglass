(function () {
  function QuestionariosController(QuestionariosService) {
    var vm = this;
    vm.questionarios = [];

    //ao iniciar
    recuperarQuestionarios();

    //funcoes
    function recuperarQuestionarios() {
      QuestionariosService.recuperar()
        .then(function () {
          vm.questionarios = QuestionariosService.questionarios;
        })
    }
  }

  angular.module('questionarioApp')
    .controller('QuestionariosController', QuestionariosController);
})();
