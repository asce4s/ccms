@extends('admin.master')
@section('scripts')



    <script>
        $(function () {

            var input = document.getElementById('pw');
            input.oninvalid = function(event) {
                event.target.setCustomValidity('Password should be 6 or more characters long \nMust contain a special character e.g \@ \nMust contain an uppercase letter\nMust contain a number');
            }
        })
    </script>
@stop
@section('title')
    Settings
@stop

@section('desc')

@stop

@section('content')
    <div class="row" ng-controller="pwController" ng-cloak>

        <div class="col-md-6">
            <div class="alert @{{ status.class }} alert-dismissible" ng-if="status.stat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> @{{status.msg}} !</h4>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Change Password</h3>
                </div>

                <form name="frm">
                    <input name="emp._token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" ng-model="data.cpw" required pattern="^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{6,}$" id="pw">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" ng-model="data.npw" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" ng-model="data.cnpw" required>
                            <span class="alert-danger" ng-bind="errorMsg"></span>
                        </div>

                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" ng-click="frm.$valid && add()">Change
                        </button>

                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <script>
        app.controller('pwController', function ($scope, $http) {
            $scope.data = {};
            $scope.add = function () {
                //console.log($scope.data);
                $scope.errorMsg = "";
                if ($scope.data.npw != $scope.data.cnpw) {
                    $scope.errorMsg = "Confirm password doesn't match";
                    return;
                }

                $http({
                    method: "post",
                    url: "{{ url('settings') }}",
                    data: $.param($scope.data),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (response) {
                    $scope.data = {};
                    $scope.status = response.data;
                }, function (response) {
                    $scope.status = {
                        msg: "Error..Contact System Administrator ",
                        class: "alert-danger",
                        stat: true
                    }
                });
            }


        })


    </script>


@stop

