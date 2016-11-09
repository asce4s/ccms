@extends('admin.master')
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">
@stop
@section('scripts')
    <script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $(".select2").select2();
        })
    </script>
@stop


@section('title')
    Manage lab items
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="labController" ng-cloak>

        <div class="col-md-6">
            <div class="alert @{{ status.class }} alert-dismissible" ng-if="status.stat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> @{{status.msg}} !</h4>
            </div>
            <div class="box box-primary">
                <div class="overlay" ng-if="formProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">@{{titletxt}} Items</h3>
                </div>

                <form name="frm" ng-init="loadBrand()">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Item Code</label>
                            <input type="text" class="form-control" ng-model="data.itemcode" name="itemcode" required>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" ng-model="data.name" name="name" required>
                        </div>


                        <div class="form-group">
                            <label>Price</label>

                            <div class="input-group">
                                <span class="input-group-addon">Rs</span>
                                <input type="float" class="form-control" ng-model="data.price" name="price" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" ng-model="data.qty" name="qty" required>
                        </div>

                        <div class="form-group">
                            <label>Minimum Quantity</label>
                            <input type="number" class="form-control" ng-model="data.minqty" name="minqty" required>
                        </div>


                        <div class="form-group">
                            <label>Brand</label>
                            <select class="form-control select2" style="width: 100%;" ng-model="data.brand_id" name="brand_id"
                                    id="brand">
                                <option ng-repeat="i in brandlist" value="@{{i.id  }}">@{{ i.name }}</option>
                            </select>
                        </div>


                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()" ng-if="!show">Add
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="update()" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete()" ng-if="show"
                                confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
                        </button>
                        <button type="reset" class="btn btn-primary" ng-click="reset()">Reset</button>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-md-6">

            <div class="box">
                <div class="overlay" ng-if="tableProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Item Data</h3>
                    <div class="box-body">

                        <table datatable dt-options="dtOptions" dt-instance="dtInstance" dt-columns="dtColumns"
                               ng-init="dataLoad('{{url('doc')}}/all')"
                               class="table table-bordered table-hover"></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="row" ng-controller="brandController">
        <div class="col-md-6">
            <div class="alert @{{ status.class }} alert-dismissible" ng-if="status.stat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> @{{status.msg}} !</h4>
            </div>
            <div class="box box-primary">
                <div class="overlay" ng-if="formProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">@{{titletxt}} Brand</h3>
                </div>

                <form name="frm2">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" ng-model="data.name" required>
                        </div>


                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm2.$valid && addx()">Add</button>

                        <button type="reset" class="btn btn-primary" ng-click="reset()">Reset</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>


        app.controller('labController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl = '{{url('labitems')}}';
            @if(!empty($data))
                    $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset = false;
                    @endif

            var cols = [
                        DTColumnBuilder.newColumn('itemcode').withTitle('Item'),
                        DTColumnBuilder.newColumn('name').withTitle('Name'),
                        DTColumnBuilder.newColumn('brand.name').withTitle('Brand'),

                    ];

            $scope.initTable(cols);


            $scope.brandlist = {};

            $scope.loadBrand = function () {
                $scope.formProgress = true;
                $http({
                    method: "GET",
                    url: "{{url('brand')}}/table",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    console.log(response.data);
                    $scope.brandlist = response.data;

                }, function (response) {

                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;

            }

            $scope.$on('brandadded', function () {
                $scope.loadBrand();

            })


        })

        app.controller('brandController', function ($scope, $http, $rootScope) {

            $scope.baseUrl = '{{url('brand')}}';
            $scope.formProgress = false;
            $scope.addx = function () {

                $scope.formProgress = true;
                $http({
                    method: "post",
                    url: $scope.baseUrl,
                    data: $.param($scope.data),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    console.log(response.data);
                    $scope.status = response.data;
                    $rootScope.$broadcast('brandadded');

                }, function (response) {

                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;

            }


        })


    </script>


@stop