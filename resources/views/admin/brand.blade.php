@extends('admin.master')



@section('title')
    Manage Brands
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="brandController" ng-cloak>

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

                <form name="frm">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control" ng-model="data.name" name="brand" required>
                        </div>


                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()" ng-if="!show" >Add</button>
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
                    <h3 class="box-title">Brand Data</h3>
                    <div class="box-body">

                        <table datatable dt-options="dtOptions" dt-instance="dtInstance" dt-columns="dtColumns"
                               ng-init="dataLoad()"
                               class="table table-bordered table-hover"></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </div>

    <script>


        app.controller('brandController', function ($scope,$http, $controller,  DTOptionsBuilder, DTColumnBuilder) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl='{{url('brand')}}';
            @if(!empty($data))
                $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset=false;
            @endif

            var cols = [

                    DTColumnBuilder.newColumn('name').withTitle('Name'),


                ];

            $scope.initTable(cols);


        })


    </script>


@stop