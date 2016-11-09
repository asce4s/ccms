@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>




    <script>
        $(function () {

            $('#datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $("[data-mask]").inputmask();

            var input = document.getElementById('nic');
            input.oninvalid = function(event) {
                event.target.setCustomValidity('NIC should be in the correct format. E.g 982695032V');
            }
        })


    </script>
@stop


@section('title')
    Manage Patients
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="patientController" ng-cloak>

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
                    <h3 class="box-title">@{{titletxt}} Patient</h3>
                </div>

                <form name="frm">
                    <input name="data._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" ng-model="data.name" name="name" required>
                        </div>

                        <div class="form-group">

                            <label style="display: block">Gender</label>
                            <label>
                                <input type="radio" ng-model="data.gender"  name="gender" value="male">
                                Male
                            </label>
                            <label>
                                <input type="radio" ng-model="data.gender"  name="gender" value="female">
                                 Female
                            </label>

                        </div>
                        <div class="form-group">
                            <label>Date of birth</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" ng-model="data.dob" name="dob">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>NIC</label>
                            <input type="text" class="form-control" ng-model="data.nic" pattern="^[0-9]{9}[vVxX]$" name="nic">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" ng-model="data.addr" required name="addr"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" class="form-control" ng-model="data.phone" name="phone" required data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
        <div class="col-md-6">
            <div class="box">
                <div class="overlay" ng-if="tableProgress">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Patient Data</h3>
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


        app.controller('patientController', function ($scope,$http, $controller,  DTOptionsBuilder, DTColumnBuilder) {

            $controller('masterController', {$scope: $scope});
            $scope.baseUrl='{{url('patient')}}';
            @if(!empty($data))
                    $scope.data = <?=$data ?>;
            $scope.show = true;
            $scope.showReset=false;
                    @endif
            var cols = [
                //DTColumnBuilder.newColumn('id').withTitle('ID'),
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('nic').withTitle('NIC'),


            ];

            $scope.initTable(cols);



        })


    </script>


@stop