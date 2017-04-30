var mainCtrl = angular.module('mainCtrl',  []);

/*mainCtrl.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

mainCtrl.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, data,sku,uploadUrl){
        var fd = new FormData();
        fd.append('image', file);
        fd.append('category', data.category);
        fd.append('subcategory', data.subcategory);
        fd.append('item_name', data.item_name);
        fd.append('uom', data.uom);
        fd.append('sku', sku);
        console.log(sku);
        fd.append('status', data.status);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        }).success(function(response){
        }).error(function(){
        });
    }
}]);*/

mainCtrl.controller('itemCtrl', function($scope, $http, fileUpload)
{
    $http({
      method: 'GET',
      url: 'api/manage-items/items/offset/'+0 +'/limit/'+8
    }).then(function (response){
        $scope.manageItems = response.data;
    },function (error){

   });
    $scope.sku = [];
    $scope.addfield=function(){
        var newItem =$scope.sku.length+1;
        $scope.sku.push(newItem);
    };
    $scope.submit=function()
    { 
        var sku =$scope.sku;
        console.log(sku);
        var file = $scope.image;
        var uploadUrl = "/os/api/manage-items/items";
        
        var data = {
                category    : $scope.category,
                subcategory : $scope.subcategory,
                item_name   : $scope.item_name,
                uom         : $scope.uom,
                status:1
            };
        fileUpload.uploadFileToUrl(file, data,sku, uploadUrl);
    };  
});
mainCtrl.directive('fileModel',['$parse',function($parse){
    return {
        restrict:'A',
        link:function(scope, element, attrs){
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change',function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

mainCtrl.service('fileUpload',['$https:',function($https:){
    this.uploadFileToUrl = function(file, uploadUrl){
        var fd = new FormData();
        fd.append('file',file);
        $https:.post(uploadUrl,fd,{
            transformRequest: angular.identity,
            headers :{
                'Content-Type':undefined
            }
        }).success(function(){

        }).error(function(){

        });
    }
}]);

mainCtrl.controller('myCtrl',['$scope','fileUpload', function($scope, fileUpload){
    $scope.uploadFile = function(){
        var file = $scope.myFile;

        console.log('file is ');
        console.dir(file);

        var uploadUrl = "/fileUpload";
        fileUpload.uploadFileToUrl(file, uploadUrl);
    };
}]);