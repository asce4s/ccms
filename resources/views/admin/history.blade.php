@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>




    <script>
        $(function () {

            $('#datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $("#datepicker").datepicker("setDate", new Date());
        })
    </script>
@stop


@section('title')
    Manage Records
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="historyController" ng-cloak>

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
                    <h3 class="box-title">@{{titletxt}} Record</h3>
                </div>

                <form name="frm">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Patient</label>
                            <input type="text" class="form-control" ng-model="nme" name="patient_name" required disabled
                                   placeholder="Select from the table">
                            <input type="hidden" class="form-control" ng-model="data.patient_id" name="patient_id" required >
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" ng-model="data.date" name="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Prescription</label>
                            <textarea class="form-control" ng-model="data.prescription" name="prescription" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" ng-model="data.note" name="note" required></textarea>
                        </div>


                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add('doc')" ng-if="!show">
                            Add
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="update('doc')" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete('doc')" ng-if="show"
                                confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
                        </button>
                        <button type="reset" class="btn btn-primary" ng-click="reset()" ng-if="showReset">Reset</button>
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
                    <h3 class="box-title">Patient Data</h3>
                    <div class="box-body">

                        <table datatable class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>NIC</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patients as $i)
                                <tr ng-click="rowClick({{$i->id}},'{{$i->name}}')">
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>
                                    <td>{{$i->nic}}</td>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>

    <script>


        app.controller('historyController', function ($scope, $http) {
            $scope.baseUrl = '{{url('history')}}';
            $scope.data = {};

            $scope.nme="";
            $scope.tableData = null;
            $scope.show = false;
            $scope.showReset = true;
            $scope.status = {
                msg: "",
                class: "",
                stat: false
            }
            $scope.formProgress = false;
            $scope.tableProgress = false;
            $scope.titletxt = "Add";

            @if(!empty($data))
                    $scope.data = <?=$data ?>;
                    $scope.show = true;
                    $scope.showReset=false;
            @endif

                    $scope.add = function () {
                $scope.formProgress = true;
                $http({
                    method: "post",
                    url: $scope.baseUrl,
                    data: $.param($scope.data),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    console.log(response.data);
                    $scope.data = {};
                    $scope.status = response.data;

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
                    url: $scope.baseUrl + "/" + $scope.data.id,
                    data: $.param($scope.data),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    $scope.status = response.data;

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
                    url: $scope.baseUrl + "/" + $scope.data.id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    $scope.data = {};
                    $scope.status = response.data;
                    $scope.show = false;
                }, function (response) {
                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
                $scope.formProgress = false;
            }

            $scope.rowClick = function (id,name) {
                $scope.nme = name;
                $scope.data.patient_id = id;

            }


        })


    </script>


@stop