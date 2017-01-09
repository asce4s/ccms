@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ URL::asset('js/jquery.base64.js') }}"></script>
    <script src="{{ URL::asset('js/tableExport.js') }}"></script>

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
    Expenses
@stop

@section('desc')

@stop

@section('content')

    <div class="row" ng-controller="saleController">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-9">
                        <form action="{{url('expense')}}/view" method="get" class="form-inline">

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

                    <div class="col-md-3">
                        <button ng-click="export()" class="btn btn-default" style="float: right;    margin-top: 20px;">
                            Download Report
                        </button>
                    </div>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table datatable class="table table-bordered table-striped" id="statTable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Task</th>
                            <th>Cost (Rs )</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sum = 0;?>
                        @if(!empty($data))
                            @foreach($data as $i)
                                <?php $sum += $i->cost; ?>
                                <tr>
                                    <td>{{$i->date}}</td>
                                    <td>{{$i->task}}</td>
                                    <td>{{$i->cost}}</td>
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


        </div>
    </div>

    <script>


        app.controller('saleController', function ($scope, $http, $controller, SweetAlert) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl = '{{url('drug')}}';


            $scope.saleID = null;
            $scope.total = 0.00;

            $scope.export=function () {


                angular.element("#statTable").tableExport({type:'excel',escape:'false',ignoreColumn:'[3]'});
                return false;
            }


        });


    </script>

@stop