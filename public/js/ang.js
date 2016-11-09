var app=angular.module('ccms', ['ui.bootstrap.tpls','angular-confirm','datatables','AngularPrint','oitozero.ngSweetAlert']);


app.controller('masterController',function ($scope, $http,DTOptionsBuilder, DTColumnBuilder,$interval) {


    $scope.data = {};
    $scope.tableData = null;
    $scope.show = false;
    $scope.status = {
        msg: "",
        class: "",
        stat: false
    }
    $scope.formProgress=false;
    $scope.tableProgress=false;
    $scope.baseUrl=null;
    $scope.titletxt="Add";

    $scope.initTable=function (cols) {
        $scope.dtColumns=cols;
        $scope.dtInstance = {};
        $scope.dtOptions = DTOptionsBuilder.newOptions().withOption('data', $scope.tableData);
    }


    $scope.add = function () {
        $scope.formProgress=true;
        $http({
            method: "post",
            url: $scope.baseUrl,
            data: $.param($scope.data),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            console.log(response.data);
            $scope.data = {};
            $scope.dataLoad();
            $scope.status=response.data;

        }, function (response) {
            console.log(response.data);
            $scope.status = {
                msg: "Error..Contact System Administrator ",
                class: "alert-danger",
                stat: true
            }
        });
        $scope.formProgress=false;

    }

    $scope.update = function () {
        $scope.formProgress=true;

        $http({
            method: "put",
            url:  $scope.baseUrl+"/"+ $scope.data.id,
            data: $.param($scope.data),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            $scope.dataLoad();
            $scope.status=response.data;

        }, function (response) {
            $scope.status = {
                msg: "Error..Contact System Administrator ",
                class: "alert-danger",
                stat: true
            }
        });
        $scope.formProgress=false;

    }


    $scope.delete = function () {
        $scope.formProgress=true;
        $http({
            method: "delete",
            url:  $scope.baseUrl+"/"+ $scope.data.id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            console.log(response.data);
            $scope.data = {};
            $scope.dataLoad();
            $scope.status=response.data;
            $scope.show=false;
        }, function (response) {
            console.log(response.data);
            $scope.status = {
                msg: "Error..Contact System Administrator ",
                class: "alert-danger",
                stat: true
            }
        });
        $scope.formProgress=false;
    }


    $scope.dataLoad = function () {
        $scope.tableProgress=true;
        $http({
            method: "GET",
            url: $scope.baseUrl+"/table",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            console.log(response.data);
            $scope.tableData = response.data;
            $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withOption('data', $scope.tableData)
                .withOption('autoWidth', 'true')
                .withOption('fnRowCallback', function (nRow, aData) {
                    $('td', nRow).bind('click', function() {
                        $scope.$apply(function() {
                            $scope.rowClick(aData);

                        });
                    });
                    return nRow;
                });
            $scope.dtInstance._renderer.rerender();

        }, function (response) {
            $("body").html(response.data);

        });
        $scope.tableProgress=false;

    }

    $scope.rowClick = function (tableData) {
        $scope.titletxt="Update";
        $scope.data = tableData;
        $scope.show = true;


    }

    $scope.reset = function () {
        $scope.titletxt="Add";
        $scope.data = {};
        $scope.show = false;

    }




     $interval(function() {
         if($scope.status.stat){
            
              $scope.status.stat=false;
         }
       }, 5000);

})
