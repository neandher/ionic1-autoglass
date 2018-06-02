(function () {
  function TentativasService($http, AppConstants) {
    var service = {
      inserir: inserir,
    };
    return service;

    //funcoes
    function inserir(tentativa) {
      return $http.post(AppConstants.api + '/tentativas', tentativa, {headers: {'Content-Type': 'application/json'}});
    }
  }

  angular.module('questionarioApp')
    .factory('TentativasService', TentativasService);
})();
