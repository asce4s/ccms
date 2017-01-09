@extends('admin.master')
@section('title')
    Manage Employees
@stop

@section('scripts')

    <script>
        $(function () {

            var input = document.getElementById('nic');
            input.oninvalid = function(event) {
                event.target.setCustomValidity('NIC should be in the correct format. E.g 982695032V');
            }
        })


    </script>
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="empController" ng-cloak>

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
                    <h3 class="box-title">Add Employee</h3>
                </div>

                <form id="empForm" name="frm">
                    <input name="emp._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" ng-model="data.name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>NIC</label>
                            <input type="text" class="form-control" ng-model="data.nic" name="nic" required pattern="^[0-9]{9}[vVxX]$">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" ng-model="data.designation" name="designation" required >
                          
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" ng-model="data.addr" name="addr" required></textarea>
                        </div>
                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()" ng-if="!show">Add</button>
                        <button type="submit" class="btn btn-primary" ng-click="update()" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete()" ng-if="show"
                                confirm="This will also delete all the user accounts associated. Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
                        </button>
                        <button type="reset" class="btn btn-primary" ng-click="show = false">Reset</button>
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
                    <h3 class="box-title">Employee Data</h3>
                    <div class="box-body">
                        <table datatable dt-options="dtOptions" dt-instance="dtInstance" dt-columns="dtColumns"
                               ng-init="dataLoad()" class="table table-bordered table-hover"></table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>

    <script>


        app.controller('empController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder) {
            $controller('masterController', {$scope: $scope});
            $scope.baseUrl='{{url('emp')}}';
            @if(!empty($data))
                    $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset = false;
                    @endif
            var cols = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('nic').withTitle('NIC'),
                DTColumnBuilder.newColumn('designation').withTitle('Designation'),
                DTColumnBuilder.newColumn('addr').withTitle('Address'),
            ];


            $scope.initTable(cols);



        })


    </script>


@stop
