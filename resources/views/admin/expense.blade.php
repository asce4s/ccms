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
                format: "yyyy-mm-dd",
            });

            $("#datepicker").datepicker("setDate", new Date());

        })
    </script>
@stop


@section('title')
    Manage Expenses
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="expenseController" ng-cloak>

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
                    <h3 class="box-title">@{{titletxt}} Expense</h3>
                </div>

                <form name="frm">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" class="form-control" ng-model="data.task" name="task" required>
                        </div>

                        <div class="form-group">
                            <label>Cost</label>

                            <div class="input-group">
                                <span class="input-group-addon">Rs</span>
                                <input type="float" class="form-control" ng-model="data.cost" name="cost" required>
                            </div>

                        </div>



                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" ng-model="data.date">
                            </div>
                        </div>





                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add('doc')" ng-if="!show" >Add</button>
                        <button type="submit" class="btn btn-primary" ng-click="update('doc')" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete('doc')" ng-if="show"
                                confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
                        </button>
                        <button type="reset" class="btn btn-primary" ng-click="reset()">Reset</button>
                    </div>
                </form>
            </div>


        </div>

    </div>

    <script>


        app.controller('expenseController', function ($scope,$http, $controller,  DTOptionsBuilder, DTColumnBuilder) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl='{{url('expense')}}';
            @if(!empty($data))
                    $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset=false;
                    @endif




        })


    </script>


@stop