<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Employee;

use App\Http\Requests;
use App\Permission;
use App\Role;

class InitController extends Controller
{
    public function init()
    {

       $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->save();

        $phm = new Role();
        $phm->name = 'phm';
        $phm->display_name = 'Pharmacist';
        $phm->save();

        $lab = new Role();
        $lab->name = 'lab';
        $lab->display_name = 'Lab Assistant';
        $lab->save();

        $doc = new Role();
        $doc->name = 'doc';
        $doc->display_name = 'Doctor';
        $doc->save();

        $rec = new Role();
        $rec->name = 'rec';
        $rec->display_name = 'Receptionist';
        $rec->save();

        $fin = new Role();
        $fin->name = 'acc';
        $fin->display_name = 'Accountant';
        $fin->save();


        //permissions

        $all = new Permission();
        $all->name = 'all';
        $all->display_name = 'All';
        $all->save();

        $manage_pharmacy = new Permission();
        $manage_pharmacy->name = 'mng_ph';
        $manage_pharmacy->display_name = 'Manage pharmacy';
        $manage_pharmacy->save();

        $manage_lab = new Permission();
        $manage_lab->name = 'mng_lab';
        $manage_lab->display_name = 'Manage lab';
        $manage_lab->save();

        $manage_accounts = new Permission();
        $manage_accounts->name = 'mng_accounts';
        $manage_accounts->display_name = 'Manage accounts';
        $manage_accounts->save();

        $manage_patients = new Permission();
        $manage_patients->name = 'mng_patients';
        $manage_patients->display_name = 'Manage patients';
        $manage_patients->save();

        $manage_admin = new Permission();
        $manage_admin->name = 'mng_admin';
        $manage_admin->display_name = 'Manage admin';
        $manage_admin->save();

        $manage_reception = new Permission();
        $manage_reception->name = 'mng_reception';
        $manage_reception->display_name = 'Manage reception';
        $manage_reception->save();

        $manage_booking = new Permission();
        $manage_booking->name = 'mng_booking';
        $manage_booking->display_name = 'Manage booking';
        $manage_booking->save();

        $admin->attachPermission($all);
        $admin->attachPermission($manage_pharmacy);
        $admin->attachPermission($manage_accounts);
        $admin->attachPermission($manage_admin);
        $admin->attachPermission($manage_lab);
        $admin->attachPermission($manage_patients);



        $doc->attachPermission($manage_patients);
        $phm->attachPermission($manage_pharmacy);
        $fin->attachPermission($manage_accounts);
        $rec->attachPermission($manage_booking);
        $rec->attachPermission($manage_reception);
        $lab->attachPermission($manage_lab);



        $emp = new Employee();
        $emp->name = "admin";
        $emp->nic ="920781098V";
        $emp->designation = 'Admin';
        $emp->addr = "addre";
        $emp->save();


        $user = new User();

        $user->user ='admin';
        $user->password = \Hash::make('abc123');
        $user->emp_id = $emp->id;


        $user->save();

        $user->attachRole($admin);





    }
}
