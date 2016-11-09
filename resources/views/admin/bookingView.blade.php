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

                            </tr>


                        @endforeach


                        </tbody>
                        <tfoot>


                        </tfoot>


                    </table>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Sale #@{{ saleID }}</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td>Qty</td>
                                    <td>Name</td>
                                    <td>Brand</td>
                                    <td>Price</td>
                                    <td>Subtotal</td>
                                    <td print-remove></td>

                                </tr>
                                </thead>
                                <tbody>

                                <tr ng-repeat="i in saleData">

                                    <td>@{{ i.qty }}</td>
                                    <td>@{{ i.name }}</td>
                                    <td>@{{ i.brand }}</td>
                                    <td>Rs. @{{ i.price }}</td>
                                    <td>Rs. @{{ i.price * i.qty }}</td>

                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4"><h4 style="text-align: right">Total</h4></td>
                                    <td><h4>Rs. @{{total}}</h4></td>
                                    <td print-remove></td>

                                </tr>


                                </tfoot>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Get Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


        app.controller('saleController', function ($scope, $http, $controller, SweetAlert) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl = '{{url('drug')}}';

            $scope.saleData = {};
            $scope.saleID = null;
            $scope.total = 0.00;
            $scope.saleView = function (id, total) {
                $scope.saleID = id;
                $scope.total = total;
                $http({
                    method: "get",
                    url: $scope.baseUrl + "/getsale?id=" + id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {

                    $scope.saleData = response.data;
                    console.log(response.data);

                    //angular.element('body').html(response.data);

                }, function (response) {

                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });

            }

        });


    </script>

@stop