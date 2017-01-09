<!-- Main Header -->
<header class="main-header">
<?php
$user = Auth::user();
?>
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CC</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CCMS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu" ng-controller="notificationController">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">@{{ notData.length }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have @{{ notData.length }} notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                @if($user->hasRole('admin'))
                                    <li ng-repeat="i in notData">
                                        <a href="#">
                                           @{{ i[0] }}
                                        </a>
                                    </li>
                                @else

                                    <li ng-repeat="i in notData">
                                        <a href="#">
                                            Stock on @{{ i.name }} is low
                                        </a>
                                    </li>

                                @endif

                            </ul>
                        </li>

                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{$user->user}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('settings')}}" class="btn btn-default btn-flat">Settings</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{url('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
</header>

<script>
    app.controller('notificationController',function ($scope,$http) {

        $scope.notData={};



        @if($user->hasRole('phm'))
            <?php $urlx=url('notification/drug') ?>
        @endif

        @if($user->hasRole('lab'))
            <?php $urlx=url('notification/item') ?>
        @endif

        @if($user->hasRole('admin'))
             <?php $urlx=url('notification/all') ?>
        @endif



@if(isset($urlx))
        $http({
            method: "GET",
            url: "{{$urlx}}",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            console.log(response.data);
            $scope.notData=response.data;
        }, function (response) {
            $("body").html(response.data);

        });
        @endif

    })


</script>
