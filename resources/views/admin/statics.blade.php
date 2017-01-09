@extends('admin.master')
@section('styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <style>
        .text-right {
            width: 300px;
        }

        #js-legend{
            position: absolute;
            top: 80px;
        }
        .chart-legend li span{
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;

        }

        .doughnut-legend{list-style: none}

        .chart {
            padding-top: 57px;
            padding-bottom: 60px;
        }
    </style>
@stop
@section('scripts')

    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('plugins/chartjs/Chart.min.js') }}"></script>



    <script>
        $(function () {

            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $("[data-mask]").inputmask();

            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas);
            var PieData = [

                @foreach($idata as $v)
                {
                    value: {{$v->price}},
                    label: "{{$v->section}}"
                },

                @endforeach

            ];
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: "#fff",
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: "easeOutBounce",
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var myChart=pieChart.Doughnut(PieData, pieOptions);
            document.getElementById('js-legend').innerHTML = myChart.generateLegend();

        })
    </script>
@stop

@section('title')
    Statics


@stop

@section('desc')

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{url('statics')}}" method="get">
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
                    </form>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table>
                        <tr>
                            <td><h3>Total Income</h3></td>
                            <td class="text-right"><h3>Rs: {{$income}}</h3></td>

                        </tr>

                        <tr>

                            <td><h3>Total Expenses</h3></td>
                            <td class="text-right"><h3>Rs: {{$expense}}</h3></td>
                        </tr>

                        <tr>
                            <td><h3>Profit</h3></td>
                            <td class="text-right"><h3>Rs: {{$income-$expense}}</h3></td>
                        </tr>
                    </table>

                    <div class="chart">
                        <div id="js-legend" class="chart-legend"></div>
                        <canvas id="pieChart" style="height:230px"></canvas>

                    </div>


                </div>
                <!-- /.box-body -->
            </div>


        </div>



@stop