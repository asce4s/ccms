@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>




    <script>
        $(function () {

            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $("[data-mask]").inputmask();
        })
    </script>
@stop

@section('title')
    Bookings {{ isset($_GET["date"]) ? "for  ".$_GET["date"] : "for  ".\Carbon\Carbon::now()->toDateString()}}
@stop

@section('desc')

@stop

@section('content')

    <div class="row" ng-controller="saleController">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{url('booking')}}/view" method="get">
                        <div class="form-group col-md-3">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="date"
                                       value="<?php echo isset($_GET["date"]) ? $_GET["date"] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label> </label>
                            <button type="submit" class="btn btn-primary" style="margin-top: 24px;">View</button>

                        </div>
                    </form>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table datatable class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Token</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Fee</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $i)
                            <tr>
                                <td>{{$i->token}}</td>
                                <td>{{$i->name}}</td>
                                <td>{{$i->nic}}</td>
                                <td>{{$i->phone}}</td>
                                <td>{{$i->doc}}</td>
                                <td>{{$i->fromTime}}</td>
                                <td>{{$i->toTime}}</td>
                                <td>{{$i->fee}}</td>
                                <td>
                                    @if(empty($i->sale_id))
                                        <a href="" class="btn btn-xs btn-danger" confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}" id="bk{{$i->id}}" ng-click="pay({{$i->id}},{{$i->fee}})">Pay</a>
                                    @else
                                        <a href="#" class="btn btn-xs btn-success">Paid</a>
                                    @endif

                                </td>


                            </tr>


                        @endforeach


                        </tbody>
                        <tfoot>


                        </tfoot>


                    </table>
                </div>
                <!-- /.box-body -->
            </div>


    <script>


        app.controller('saleController', function ($scope, $http, $controller, SweetAlert) {

            $scope.baseUrl = '{{url('booking')}}';

            $scope.pay=function (id,fee) {

                $http({
                    method: "put",
                    url: $scope.baseUrl+"/"+id+"?pay=true",
                    data: $.param({fee:fee}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    if(response.data){
                        var ee=angular.element("#bk"+id);
                        ee.html("paid");
                        ee.removeClass("btn-danger");
                        ee.addClass("btn-success");
                        ee.removeAttr("confirm");
                        ee.removeAttr("confirm-settings");
                        ee.removeAttr("ng-click");
                        ee.addClass("cevent");
                    }

                }, function (response) {

                });
            }

        });


    </script>

@stop