<aside class="main-sidebar">
<?php
$user = Auth::user();

?>
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @if($user->can(['all','mng_reception','mng_booking']))
                <li class="header">Channelling</li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>Booking</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('booking')}}">Add</a></li>
                        <li><a href="{{url('booking')}}/view">View</a></li>
                    </ul>
                </li>
                <li><a href="{{url('schedule')}}"><i class="fa fa-list-alt"></i> <span>Schedule</span></a></li>
            @endif
            @if($user->can(['all','mng_reception','mng_patients']))
                <li class="header">Patiants</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>Manage Patients</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('patient')}}">Add / Edit</a></li>
                        <li><a href="{{url('patient')}}/all">View</a></li>
                    </ul>
                </li>
                @if($user->can(['all','mng_patients']))
                    <li class="treeview">
                        <a href="#"><i class="fa fa-folder"></i> <span>Manage Records</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('history')}}">Add</a></li>
                            <li><a href="{{url('history')}}/all">View</a></li>
                        </ul>
                    </li>
                @endif

            @endif
            @if($user->can(['all','mng_ph','mng_lab']))

                <li class="header">Brand</li>
                <li><a href="{{url('brand')}}"><i
                                class="fa fa-book"></i> <span>Brands</span></a></li>

            @endif
            @if($user->can(['all','mng_lab','mng_accounts']))

                <li class="header">Lab</li>

                <li><a href="{{url('lab')}}"><i class="fa fa-flask"></i> <span>Lab Tests</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-medkit"></i> <span>Items</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('labitems')}}">Add / Edit</a></li>
                        <li><a href="{{url('labitems')}}/all">View</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-medkit"></i> <span>Tests</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('labtest')}}">Add / Edit</a></li>
                        <li><a href="{{url('labtest')}}/all">View</a></li>
                    </ul>
                </li>

                <li><a href="{{url('lab')}}/view?from={{date('Y-m-d')}}&to={{date('Y-m-d')}}"><i class="fa fa-book"></i>
                        <span>Sales</span></a></li>
            @endif
            @if($user->can(['all','mng_ph','mng_accounts']))
                <li class="header">Pharmacy</li>

                <li><a href="{{url('pharmacy')}}"><i class="fa fa-cart-arrow-down"></i> <span>Pharmacy</span></a>
                </li>
                <li class="treeview">
                    <a href=""><i class="fa fa-medkit"></i> <span>Items</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('drug')}}">Add / Edit</a></li>
                        <li><a href="{{url('drug')}}/all">View</a></li>
                    </ul>
                </li>

                <li><a href="{{url('pharmacy')}}/view?from={{date('Y-m-d')}}&to={{date('Y-m-d')}}"><i
                                class="fa fa-book"></i> <span>Sales</span></a></li>
            @endif

            @if($user->can(['all','mng_accounts']))
                <li class="header">Finance</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span>Expenses</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('expense')}}">Add / Edit</a></li>
                        <li><a href="{{url('expense')}}/all">View</a></li>
                    </ul>
                </li>

                <li><a href="{{url('income')}}"><i class="fa fa-clipboard"></i> <span>Income</span></a></li>
                <li><a href="{{url('statics')}}?from=2016-12-06&to=2016-12-06"><i class="fa fa-line-chart"></i> <span>Statics</span></a></li>
            @endif


            @if($user->can(['all','mng_admin']))
                <li class="header">Control Panel</li>
                <li><a href="{{url('users')}}"><i class="fa fa-user"></i> <span>Users</span></a></li>


                <li class="treeview">
                    <a href="#"><i class="fa fa-briefcase"></i> <span>Employees</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('emp')}}">Add / Edit</a></li>
                        <li><a href="{{url('emp')}}/all">View</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-stethoscope"></i> <span>Doctors</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('doc')}}">Add / Edit</a></li>
                        <li><a href="{{url('doc')}}/all">View</a></li>
                    </ul>
                </li>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>