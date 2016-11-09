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
    Laboratary
@stop

@section('desc')

@stop

@section('content')
    <div ng-controller="drugController" ng-cloak>
        <div class="row" print-remove>

            <div class="col-md-6">
                <div class="alert @{{ status.class }} alert-dismissible" ng-if="status.stat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> @{{status.msg}} !</h4>
                </div>

                <div class="box box-primary">
                    <form name="frmt">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Select a test</label>
                                <select class="form-control select2" ng-model="data.test" name="test" required
                                        ng-change="roleChange()"
                                        id="role">
                                    @foreach ($tests as $test)
                                        <option value="{{$test}}" rel="{{$test->name}}">{{$test->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" ng-click="frmt.$valid && addTestToTable()">Add
                            </button>

                        </div>
                    </form>
                </div>
                <div class="box box-primary">
                    <div class="overlay" ng-if="formProgress">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Sale Items</h3>
                    </div>

                    <form name="frm">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="box-body">

                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" class="form-control" ng-model="data.name" name="name" required disabled
                                       placeholder="Select item from the table">

                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" ng-model="data.quantity" name="quantity" required>
                            </div>


                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" ng-click="frm.$valid && addToTable()">Add
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
                        <h3 class="box-title">Lab Items</h3>
                        <div class="box-body">

                            <table datatable dt-options="dtOptions" dt-instance="dtInstance" dt-columns="dtColumns"
                                   ng-init="dataLoad()"
                                   class="table table-bordered table-hover"></table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row" print-section>
            <div class="col-md-6">
                <div class="alert @{{ st.class }} alert-dismissible" ng-if="st.stat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> @{{st.msg}} !</h4>
                </div>
                <div class="box box-success">
                    <div class="overlay" ng-if="fProgress">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Sale</h3>
                    </div>
                    <div class="box-body">
                        <h4>Tests</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th print-remove></th>

                            </tr>
                            </thead>

                            <tbody>
                            <tr ng-repeat="i in testSalesList">
                                <td>@{{ i.name }}</td>
                                <td>Rs. @{{ i.price }}</td>
                                <td print-remove><a ng-click="testSalesList.splice($index,1);removeFromTestTable(i)"><i
                                                class="fa fa-times"
                                                aria-hidden="true"></i></a>
                                </td>

                            </tr>

                            </tbody>
                       </table>
                        <hr>
                        <h4>Items</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th print-remove></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="i in salesList">
                                <td>@{{ i.quantity }}</td>
                                <td>@{{ i.name }}</td>
                                <td>@{{ i.brand.name }}</td>
                                <td>Rs. @{{ i.price }}</td>
                                <td>Rs. @{{ i.price * i.quantity }}</td>
                                <td print-remove><a ng-click="salesList.splice($index,1);removeFromTable(i)"><i
                                                class="fa fa-times"
                                                aria-hidden="true"></i></a>
                                </td>

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

                        <div class="box-footer" print-remove>
                            <button type="button" class="btn btn-primary" ng-click="saleAdd()">Get Invoice
                            </button>

                            <button type="button" class="btn btn-primary" ng-click="salesList=[];total=0">Reset</button>
                        </div>


                    </div>


                </div>

            </div>
        </div>

    </div>
    <script>


        app.controller('drugController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder, SweetAlert) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl = '{{url('lab')}}';
            var cols = [
                DTColumnBuilder.newColumn('itemcode').withTitle('Item Code'),
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('qty').withTitle('Qty'),
                DTColumnBuilder.newColumn('price').withTitle('Price (Rs)'),


            ];

            $scope.initTable(cols);
            $scope.salesList = [];
            $scope.testSalesList = [];
            $scope.total = 0.00;

            $scope.addToTable = function () {

                if ($scope.data.qty < $scope.data.quantity) {
                    SweetAlert.swal("Error", "You don't have enough quantity", "error");
                }
                else {
                    $scope.data.qty = $scope.data.qty - $scope.data.quantity;
                    var data = $scope.data
                    $scope.total += data.price * data.quantity;
                    $scope.salesList.push(data);
                }

            }

            $scope.addTestToTable = function () {
                    var data = JSON.parse($scope.data.test);

                    $scope.total += data.price;
                    $scope.testSalesList.push(data);


            }

            $scope.removeFromTestTable = function (i) {
                $scope.total -=  i.price;

            }

            $scope.removeFromTable = function (i) {
                i.qty = i.qty + i.quantity;
                $scope.total -= i.quantity * i.price;

            }

            $scope.saleAdd = function () {

                if ($scope.salesList.length != 0) {
                    $scope.fProgress = true;
                    $http({
                        method: "post",
                        url: $scope.baseUrl,
                        data: $.param({data: JSON.stringify($scope.salesList), total: $scope.total,testData:JSON.stringify($scope.testSalesList)}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function (response) {
                        window.print();
                        $scope.st = response.data;
                        $scope.salesList = [];
                        $scope.total = 0;
                        $scope.reset();

                    }, function (response) {

                        $scope.st = {
                            msg: "Error..Contact System Administrator ",
                            class: "alert-danger",
                            stat: true
                        }
                    });
                    $scope.fProgress = false;
                }
            }

            $scope.rowClick = function (tableData) {

                if (tableData.qty < 1) {
                    SweetAlert.swal("Error", "You don't have enough quantity", "error");
                } else {
                    $scope.titletxt = "Update";
                    $scope.data = tableData;
                    $scope.show = true;
                }


            }


        })


    </script>


@stop