@extends('admin.master')

@section('scripts')
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>


    <script>
        $(function () {
            $("[data-mask]").inputmask();
            var input = document.getElementById('nic');
            input.oninvalid = function(event) {
                event.target.setCustomValidity('NIC should be in the correct format. E.g 982695032V');
            }
        })
    </script>
@stop


@section('title')
    Manage Doctors
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="docController" ng-cloak>

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
                    <h3 class="box-title">Add Doctor</h3>
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
                            <input type="text" class="form-control" ng-model="data.nic" name="nic" required  pattern="^[0-9]{9}[vVxX]$">
                        </div>
                        <div class="form-group">
                            <label>Qualifications</label>
                            <textarea class="form-control" ng-model="data.qualifications" name="qualifications" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Specialized In</label>
                            <input type="text" class="form-control" ng-model="data.specializedIn" name="specializedIn" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" class="form-control" ng-model="data.phone" name="phone" required data-inputmask='"mask": "(999) 999-9999"' data-mask>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" ng-model="data.email" name="email" >
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" ng-model="data.addr" name="addr" required></textarea>
                        </div>

                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()" ng-if="!show" >Add</button>
                        <button type="submit" class="btn btn-primary" ng-click="update()" ng-if="show">Update
                        </button>
                        <button type="submit" class="btn btn-primary" ng-click="delete()" ng-if="show"
                                confirm="Are you sure ?" confirm-settings="{size: 'sm',ok:'Yes'}">Delete
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
                    <h3 class="box-title">Doctor Data</h3>
                    <div class="box-body">

                        <table datatable dt-options="dtOptions" dt-instance="dtInstance" dt-columns="dtColumns"
                               ng-init="dataLoad('{{url('doc')}}/all')" class="table table-bordered table-hover"></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>

    <script>


        app.controller('docController', function ($scope,$http, $controller,  DTOptionsBuilder, DTColumnBuilder) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl='{{url('doc')}}';
            @if(!empty($data))
                    $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset = false;
                    @endif
            var cols = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('nic').withTitle('NIC'),
                DTColumnBuilder.newColumn('specializedIn').withTitle('Specialized In'),
                DTColumnBuilder.newColumn('email').withTitle('Email'),
            ];

            $scope.initTable(cols);



        })


    </script>


@stop
