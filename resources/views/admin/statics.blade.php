@extends('admin.master')
@section('title')
   Statics
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

            </table>
        </div>
        <!-- /.box-body -->


    </div>



@stop