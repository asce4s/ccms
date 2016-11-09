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
    Manage Users
@stop

@section('desc')

@stop

@section('content')

    <div class="row" ng-controller="userController" ng-cloak ng-init="loadEmp()">
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
                    <h3 class="box-title">Add User</h3>
                </div>

                <form name="frm">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" ng-model="user.user" name="user" id="un" required>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" ng-model="user.role" name="role" required ng-change="roleChange()"
                                    id="role" >
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" rel="{{$role->name}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group" ng-show="showAssign">
                            <label>Assign @{{ eType }}</label>
                            <select class="form-control select2" style="width: 100%;" ng-model="user.emp_id" name="emp_id" id="emp">
                                <option ng-repeat="i in assignList | filter:{designation:dc}:true"
                                        value="@{{i.id  }}">@{{ i.name }} (@{{i.designation}})</option>
                            </select>
                        </div>

                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()" ng-if="!show">Add</button>
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
                    <h3 class="box-title">Users</h3>
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


        app.controller('userController', function ($scope, $http, DTOptionsBuilder, DTColumnBuilder) {

            $scope.dtColumns = [
                DTColumnBuilder.newColumn('user').withTitle('Username'),
                DTColumnBuilder.newColumn('emp_id').withTitle('ID'),
                DTColumnBuilder.newColumn('employee.name').withTitle('Name'),
                DTColumnBuilder.newColumn('roles[0].name').withTitle('Role'),
            ];

            $scope.dtInstance = {};


            $scope.user = {};

            $scope.userData = {};


            $scope.show = false;
            $scope.status = {
                msg: "",
                class: "",
                stat: false
            };
            $scope.assignList = {};
            $scope.showAssign = false;
            $scope.formProgress = false;
            $scope.tableProgress = false;
            $scope.dc='!Doctor';
            $scope.dtOptions = DTOptionsBuilder.newOptions().withOption('data', $scope.userData);

            $scope.eType = 'an Employee';

            $scope.add = function () {
                $scope.formProgress = true;
                $http({
                    method: "post",
                    url: "{{ url('users') }}",
                    data: $.param($scope.user),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    $scope.user = {};
                    $scope.dataLoad();
                    $scope.status = {
                        msg: "User Added",
                        class: "alert-success",
                        stat: true
                    }
                }, function (response) {
                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;
            }

            $scope.update = function () {
                $scope.formProgress = true;
                $http({
                    method: "put",
                    url: "{{ url('users') }}/" + $scope.user.id,
                    data: $.param($scope.user),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    $scope.dataLoad();
                    $scope.status = {
                        msg: "User Updated",
                        class: "alert-success",
                        stat: true
                    };
                    $scope.reset();

                }, function (response) {
                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;


            }

            $scope.delete = function () {
                $scope.formProgress = true;
                $http({
                    method: "delete",
                    url: "{{ url('users') }}/" + $scope.user.id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {

                    $scope.user = {};
                    $scope.dataLoad();
                    $scope.status = {
                        msg: "User Deleted",
                        class: "alert-success",
                        stat: true
                    };
                    $scope.reset();
                }, function (response) {
                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;

            }


            $scope.dataLoad = function () {
                $scope.tableProgress = true;
                $http({
                    method: "GET",
                    url: "{{ url('users') }}/table",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    console.log(response.data);
                    $scope.userData = response.data;
                    $scope.dtOptions = DTOptionsBuilder.newOptions()
                            .withOption('data', $scope.userData)
                            .withOption('autoWidth', 'true')
                            .withOption('fnRowCallback', function (nRow, aData) {
                                $('td', nRow).bind('click', function () {
                                    $scope.$apply(function () {
                                        $scope.rowClick(aData);

                                    });
                                });
                                return nRow;
                            });
                    $scope.dtInstance._renderer.rerender();

                }, function (response) {
                    $("body").html(response.data);

                });
                $scope.tableProgress = false;

            }

            $scope.reset = function () {
                angular.element("#un").removeAttr('disabled');
                angular.element("#emp").removeAttr('disabled');
                $scope.user = {};
                $scope.show = false;
                $scope.showAssign = false;
            }

            $scope.rowClick = function (userData) {

                angular.element("#un").attr('disabled', 'disabled');
                angular.element("#emp").attr('disabled', 'disabled');

                $scope.user = userData;
                $scope.show = true;
                angular.element("#role").val("" + userData.roles[0].id + "").change();
                $scope.user.role = userData.roles[0].id;

                $scope.showAssign = true;


            }

            $scope.loadEmp=function () {
                $http({
                    method: "GET",
                    url: "{{ url('users') }}/emp",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    console.log(response.data);
                    $scope.assignList = response.data;
                }, function (response) {
                    $("body").html(response.data);

                });
            }


            $scope.roleChange = function () {
                $scope.showAssign = true;
                //var role=$scope.user.role;
                var role = angular.element("#role").find('option:selected').attr('rel');
                if (role == 'doc') {
                    $scope.eType = 'a Doctor';
                    $scope.dc='Doctor';
                }
                else {
                    $scope.eType = 'an Employee';
                    $scope.dc='!Doctor';
                }


            }


        })


    </script>


@stop
