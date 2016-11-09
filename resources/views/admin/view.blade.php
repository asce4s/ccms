@extends('admin.master')
@section('title')
    {{$title}}
@stop

@section('desc')

@stop

@section('content')


    <div class="box" ng-controller="ViewController" ng-cloak>
        <div class="box-header">
            <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table datatable class="table table-bordered table-striped">
                <thead>
                <tr>
                    @foreach($cols as $col)
                        <th>{{$col}}</th>
                    @endforeach
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php

                $size = sizeof($cols);
                ?>
                @foreach($data as $i)

                    <?php
                    $c = 0;
                    ?>
                    <tr>
                        @foreach($i as $d)
                            @if($c<$size)
                                <td>{{str_limit($d, 30)}}</td>
                            @endif
                            <?php $c++; ?>
                        @endforeach

                        <td style="width: 136px;"><a href="{{url($url)}}/{{$i->id}}" class="btn btn-xs btn-info"
                                                     style="margin-right: 5px">View</a><a
                                    href="{{url($url)}}/{{$i->id}}/edit" class="btn btn-xs btn-primary"
                                    style="margin-right: 5px">Edit</a><a href="{{url($url)}}"
                                                                         class="btn btn-xs btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    @foreach($cols as $col)
                        <th>{{$col}}</th>
                    @endforeach
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->


    </div>


    <script>
        app.controller('ViewController', function ($scope, $http, $controller, DTOptionsBuilder, DTColumnBuilder) {
            $scope.ID = null;
            $scope.modelLabels = {};
            $scope.modelData = {};

            $scope.singleView = function (title, data) {
                $scope.ID = data.id;
                $scope.modelLabels = title;
                $scope.modelData = data;

                console.log($scope.modelLabels);
                console.log($scope.modelData);

            }

        })
    </script>
@stop