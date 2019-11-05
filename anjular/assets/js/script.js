
var app = angular.module('myApp', ['ngRoute']);
  //Router Configuration
  app.config(function($routeProvider, $locationProvider) {
    $locationProvider.hashPrefix('');
    $routeProvider
    .when('/', {
      title : 'View Inventory',
      templateUrl : 'pages/inventory.html',
      controller  : 'inventoryController'
    })
    .when('/add-manufacture', {
      title : 'Add Manufacture',
      templateUrl : 'pages/add_manufacture.html',
      controller  : 'addManufacturController'
    })
    .when('/add-model', {
      title :'Add Model',
      templateUrl : 'pages/add_model.html',
      controller  : 'addModelController'
    });
  });

///controller for inventory
app.controller('inventoryController', function($scope,$http) {
  $http({
    method: 'GET',
    url: "controllers/inventory_controller.php",
    type:"json",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},

    transformRequest: (obj)=> {
      var str = [];
      for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
      return str.join("&");
    },
  }).then( (data)=> {
   console.log(data.data);
   $scope.inventory = data.data;
 });
});


//Controller from Manufacturer
app.controller('addManufacturController', function($scope,$http) {
 $scope.manu_names = ["Fiat", "Maruti", "Tata","Toyota","Honda","Jaguar"];

 $scope.submit = ()=> {

  $http({
    method: 'POST',
    url: "controllers/add_manu_controller.php",
    type:"json",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    transformRequest: (obj)=> {
      var str = [];
      for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
      return str.join("&");
    },
    data: {manufacture: $scope.st_manufacture}
  }).then( (data)=> {
    let responseData = data.data;
    if(responseData.status){
      $scope.statusMessage= $scope.st_manufacture+" has been Added";
      $scope.statusClass="success";
    }else{
      $scope.statusMessage= $scope.st_manufacture+" already exist";
      $scope.statusClass="fail";
    }
  });
}





});

app.controller('addModelController', function($scope,$http) {
  $scope.form = {st_manufacture :"select One"};
  $http({
    method: 'GET',
    url: "controllers/car_model_controller.php",
    type:"json",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},

    transformRequest: (obj)=> {
      var str = [];
      for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
      return str.join("&");
    },
  }).then( (data)=> {
   $scope.manufa = data.data;
 });

  $scope.submit = ()=> {

    var fileName_string="";
    $(".imageNames_hidden").each(function(){
      fileName_string+=$(this).val()+",";
    });
    console.log(fileName_string);
    $http({
      method: 'POST',
      url: "controllers/car_model_controller.php",
      type:"json",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      transformRequest: (obj)=> {
        var str = [];
        for(var p in obj)
          str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
      },
      data: {
        st_model: $scope.form.st_model,
        st_manufacture: $scope.form.st_manufacture,
        st_color: $scope.form.st_color,
        dt_manu_year: $scope.form.dt_manu_year,
        st_note: $scope.form.st_model_note,
        st_regNo: $scope.form.st_regNo,
        st_imageName:fileName_string
      },
    }).then( (data)=> {
     let responseData = data.data;
     if(responseData.status){
      $scope.statusMessage= $scope.form.st_model+" has been Added";
      $scope.statusClass="success";
    }else{
      $scope.statusMessage= $scope.form.st_model+" Failed To Add";

      $scope.statusClass="fail";
      if(responseData.errCode==1){
        $scope.statusMessage= "Registration Number for "+$scope.form.st_model+" already exist";
      }
    }
  });
  }



  $('#fileupload').fileupload({
    /* ... */
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $("#progress").append(' <div class="bar notdone" style="width: 0%;"></div>');
      $('#progress .bar.notdone').css(
        'width',
        progress + '%'
        ).removeClass("notdone");
    },

    success:function (result, textStatus, jqXHR) {

      result = JSON.parse(result)

     if(result.status==1){
       $('#progress .bar').last().html($("#imageNameShow").html()+result.ogFileName+"<br>");
      $("#fileshidden").append("<input type='hidden' class='imageNames_hidden' ng-model='form.st_imagenames'  value='"+result.filename+"' name='st_imagenames[]' > ");
  
     }else{
     $('#progress .bar').last().html($("#imageNameShow").html()+result.ogFileName+" Not Allowed!!!<br>");
     $('#progress .bar').last().css({"background":"#de1a1a","color":"white"})
     }
    }


  });




} ) ;



app.directive('ngModel', function() {
  return {
    require: 'ngModel',
    link: function(scope, elem, attr, ngModel) {
      elem.on('blur', function() {
        ngModel.$dirty = true;
        scope.$apply();
      });

      ngModel.$viewChangeListeners.push(function() {
        ngModel.$dirty = false;
      });

      scope.$on('$destroy', function() {
        elem.off('blur');
      });
    }
  }
});

app.run(['$rootScope', '$route', function($rootScope, $route) {
  $rootScope.$on('$routeChangeSuccess', function() {
    document.title = $route.current.title;
  });
}]);

