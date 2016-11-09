@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>


    <script>
        $(function () {

            $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function (start, end) {
                        $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                        $('#from').val(start.format('YYYY-MM-DD'));
                        $('#to').val(end.format('YYYY-MM-DD'));
                    }
            );


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
                    <form action="{{url('income')}}" method="get" class="form-inline">

                        <div class="form-group">
                            <label>Select a date range</label>

                            <div class="input-group">
                                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                        <span>
                                          <i class="fa fa-calendar"></i> Select
                                        </span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <input type="hidden" name="from" id="from">
                                <input type="hidden" name="to" id="to">


                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">View
                        </button>


                    </form>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table datatable class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Section</th>
                            <th>Income</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php $sum = 0; ?>
                        @if(!empty($data))
                            @foreach($data as $i)
                                <?php $sum += $i->price ?>
                                <tr>

                                    <td>{{$i->created_at}}</td>
                                    <td>{{$i->section}}</td>
                                    <td>Rs. {{$i->price}}</td>


                                </tr>
                            @endforeach
                        @endif
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
            $scope.baseUrl = '{{url('income')}}';

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