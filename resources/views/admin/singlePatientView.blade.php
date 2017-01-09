@extends('admin.master')
@section('title')
    {{$title}}
@stop

@section('desc')

@stop

@section('content')
    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">

            <table datatable class="table table-bordered table-striped">

                <?php

                $keys = array_keys($data);
                ?>
                @for ($i = 0; $i < sizeof($cols); $i++)
                    <tr>
                        <td style="font-weight: 700;width: 150px;">{{$cols[$i]}}</td>
                        <td>{{$data[$keys[$i]]}}</td>
                    </tr>
                @endfor

            </table>
        </div>

    </div>

    @if(!empty($sub))
        @include($sub)

    @endif
    <?php
    $user = Auth::user();

    ?>
    @if($user->hasRole('doc'))
        <a href="{{url('history')}}/patient={{$data['id']}}">
            <button class="btn btn-primary">Show records</button>
        </a>
    @endif


@stop