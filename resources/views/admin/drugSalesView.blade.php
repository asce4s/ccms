@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>

    <script src="{{ URL::asset('js/jquery.base64.js') }}"></script>
    <script src="{{ URL::asset('js/tableExport.js') }}"></script>


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
    Pharmacy Sales
@stop

@section('desc')

@stop

@section('content')

    <div class="row" ng-controller="saleController">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{url('pharmacy')}}/view" method="get">
                        <div class="form-group col-md-3">
                            <label>From</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="from"
                                       value="<?php echo isset($_GET["from"]) ? $_GET["from"] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>To</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="to"
                                       value="<?php echo isset($_GET["to"]) ? $_GET["to"] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label> </label>
                            <button type="submit" class="btn btn-primary" style="margin-top: 24px;">View</button>

                        </div>
                        <div class="col-md-3">
                            <button ng-click="export()" class="btn btn-default" style="float: right;    margin-top: 20px;">Download Report </button>
                        </div>
                    </form>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table datatable class="table table-bordered table-striped" id="statTable">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $sum = 0; ?>
                        @foreach($data as $i)
                            <?php $sum += $i->price ?>
                            <tr>

                                <td>#{{$i->id}}</td>
                                <td>{{$i->created_at}}</td>
                                <td>Rs. {{$i->price}}</td>
                                <td>
                                    <button ng-click="saleView({{$i->id}},{{ $i->price}})" type="button"
                                            class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                        View
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"><h4 class="text-right">Total</h4></td>
                            <td><h4>Rs. {{$sum}}</h4></td>
                        </tr>

                        </tfoot>


                    </table>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 print-section>
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
                        <div class="modal-footer" print-remove>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="print()">Get Invoice</button>
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
            $scope.print = function () {
                window.print();
            }

            $scope.export=function () {
                angular.element("#statTable").tableExport({type:'excel',escape:'false',ignoreColumn:'[3]'});
            }


        });






    </script>

@stop