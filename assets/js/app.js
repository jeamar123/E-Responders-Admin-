var app = angular.module('app' , ['ngRoute','ngSanitize','angularUtils.directives.dirPagination']);
// var app = angular.module('app' , ['ngRoute']);

app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);
// app.filter('to_trusted', ['$sce', function($sce){
//     return function(text) {
//         return $sce.trustAsHtml(text);
//     };
// }]);
// app.filter('split', function() {
//     return function(input, splitChar, splitIndex) {
//         return input.split(splitChar)[splitIndex];
//     }
// });
// app.animation('.animation',function(){
//   return{
//     enter: function(element,done){
//       jQuery(element).hide().fadeIn(800, done);
//     },
//     leave: function(element,done){
//       jQuery(element).fadeOut(800, done);
//     }
//   };
// });