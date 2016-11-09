@extends('admin.master')
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
@stop
@section('scripts')
    <script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

    <script>
        $(function () {
            $(".select2").select2();
            $(".timepicker").timepicker({
                showInputs: false
            });
        })
    </script>
@stop
@section('title')
    Manage Schedule
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="scheduleController" ng-cloak>

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
                    <h3 class="box-title">Add a Schedule</h3>
                </div>

                <form id="empForm">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Doctor</label>

                            <select class="form-control select2" style="width: 100%;" ng-model="data.doc_id" name="doc_id">
                                @foreach($doc as $i)
                                    <option value="{{$i->id}}">{{$i->emp->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Day of Week</label>
                            <select class="form-control select2" style="width: 100%;" ng-model="data.weekday" name="weekday">
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>


                            </select>


                        </div>

                        <div class="bootstrap-timepicker col-md-6" style="padding-left: 0;">
                            <div class="form-group">
                                <label>From</label>

                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" ng-model="data.fromTime" name="fromTime">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bootstrap-timepicker col-md-6" style="padding-right: 0;">
                            <div class="form-group">
                                <label>To</label>

                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" ng-model="data.toTime" name="toTime">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" ng-model="data.description" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Maximum number of patients</label>
                           <input type="number" class="form-control" ng-model="data.max" name="max">
                        </div>




                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="add()" ng-if="!show">Add</button>
                        <button type="submit" class="btn btn-primary" ng-click="update()" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete()" ng-if="show"
                                confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
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
                    <h3 class="box-title">Schedule Data</h3>
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


        app.controller('scheduleController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder) {
            $controller('masterController', {$scope: $scope});
            $scope.baseUrl = '{{url('schedule')}}';
            var cols = [
                DTColumnBuilder.newColumn('id').withTitle('ID'),
                DTColumnBuilder.newColumn('doctor.name').withTitle('Doctor'),
                DTColumnBuilder.newColumn('weekday').withTitle('Date'),
                DTColumnBuilder.newColumn('fromTime').withTitle('From'),
                DTColumnBuilder.newColumn('toTime').withTitle('To'),
            ];


            $scope.initTable(cols);

        })


    </script>


@stop