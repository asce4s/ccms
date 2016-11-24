@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <style>
        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
            color: #ccc;

        }
    </style>
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>




    <script>
        $(function () {


            $("[data-mask]").inputmask();

            var input = document.getElementById('nic');
            input.oninvalid = function (event) {
                event.target.setCustomValidity('NIC should be in the correct format. E.g 982695032V');
            }
        })
    </script>
@stop
@section('title')
    Manage Bookings
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="bookingController" ng-cloak>

        <div class="col-md-4">
            <div class="alert @{{ status.class }} alert-dismissible" ng-if="status.stat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> @{{status.msg}} !</h4>
            </div>
            <div class="box box-primary">
                <div class="overlay" ng-if="formProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Add a Booking</h3>
                </div>

                <form name="frm">
                    <input name="emp._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" ng-model="data.name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>NIC</label>
                            <input type="text" id="nic" class="form-control" ng-model="data.nic" required
                                   pattern="^[0-9]{9}[vVxX]$" name="nic">
                        </div>

                        <div class="form-group">
                            <label>Schedule ID</label>
                            <input type="text" class="form-control" ng-model="data.schedule_id" name="schedule_id"
                                   required disabled placeholder="Select schedule from the table">
                        </div>

                        <div class="form-group" >
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" ng-model="data.date"
                                       name="date" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" class="form-control" ng-model="data.phone" name="phone" required
                                   data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                        <button type="reset" class="btn btn-primary" ng-click="show = false;reset()">Reset</button>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="overlay" ng-if="tableProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Schedules</h3>
                    <div class="box-body">
                        <table datatable class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Doctor</td>
                                <td>Day</td>
                                <td>From</td>
                                <td>To</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sc as $i)
                                <tr ng-click="rowClick({{$i->id}},'{{$i->weekday}}')">
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->doctor->name}}</td>
                                    <td>{{$i->weekday}}</td>
                                    <td>{{$i->fromTime}}</td>
                                    <td>{{$i->toTime}}</td>
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


        app.controller('bookingController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder) {
            $scope.baseUrl = '{{url('booking')}}';

            $scope.data = {};
            $scope.tableData = null;
            $scope.show = false;
            $scope.status = {
                msg: "",
                class: "",
                stat: false
            }
            $scope.formProgress = false;
            $scope.tableProgress = false;
            $scope.titletxt = "Add";

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

            $scope.rowClick = function (id,weekday) {
                var dy;
                switch(weekday){
                    case "Sunday":dy=[1,2,3,4,5,6];break;
                    case "Monday":dy=[0,2,3,4,5,6];break;
                    case "Tuesday":dy=[0,1,3,4,5,6];break;
                    case "Wednesday":dy=[0,1,2,4,5,6];break;
                    case "Thursday":dy=[0,1,2,3,5,6];break;
                    case "Friday":dy=[0,1,2,3,4,6];break;
                    case "Saturday":dy=[0,1,2,3,4,5];break;

                }
                $scope.showdate=true;
                $scope.data.schedule_id = id;
                angular.element('#datepicker').datepicker('remove');
                angular.element('#datepicker').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    daysOfWeekDisabled: dy
                });

                angular.element('#datepicker').removeAttr("disabled");
            }

            $scope.reset=function () {
                angular.element('#datepicker').attr("disabled","disabled");

            }


        })


    </script>


@stop