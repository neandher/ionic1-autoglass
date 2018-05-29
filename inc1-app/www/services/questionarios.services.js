(function(){
  function QuestionariosService($http, $filter, AppConstants) {
    var service = {
      questionario : {},
      questionarios : [],
      questoes: [],
      recuperar : recuperar,
      recuperarDetalhe: recuperarDetalhe,
      recuperarQuestoes: recuperarQuestoes
    };
    return service;

    //funcoes
    function recuperar() {
      return $http.get(AppConstants.api + '/questionarios.json')
        .then(function (resposta) {
          service.questionarios = resposta.data;
        });
    }

    function recuperarDetalhe(codigo) {
      return $http.get(AppConstants.api + '/questionarios/'+codigo+'.json')
        .then(function (resposta) {
          //service.questionario = $filter('filter')(resposta.data, {codigo: codigo})[0];
          service.questionario = resposta.data;
        });
    }

    function recuperarQuestoes(codigoQuestionario) {
      return $http.get(AppConstants.api + '/questionarios/'+codigoQuestionario+'/perguntas.json')
        .then(function (resposta) {
          //service.questoes = $filter('filter')(resposta.data, {codigoQuestionario: codigoQuestionario});
          service.questoes = resposta.data;
        });
    }
  }
  angular.module('questionarioApp')
    .factory('QuestionariosService', QuestionariosService);
})();
