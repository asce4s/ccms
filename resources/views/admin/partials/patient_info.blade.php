<h1><small>Patient Info

    </small>
</h1>

<div class="box" ng-controller="ViewController" ng-cloak>
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table datatable class="table table-bordered table-striped n">

            <?php
            $keys = array_keys($subData);
            ?>
            @for ($i = 0; $i < sizeof($cols); $i++)
                <tr>
                    <td style="width: 150px;">{{$subTitles[$i]}}</td>
                    <td>{{$subData[$keys[$i]]}}</td>
                </tr>
            @endfor

        </table>
    </div>

</div>
