<?php

namespace App\Http\Controllers;

use App\Role;
use DB;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = DB::table('roles')->get();
        $emp=DB::table('employee')->get();
        return view('admin.users')->with('roles', $roles)->with('emp',$emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//return $_POST;
        $user = new User();

        $user->user = $request->get('user');
        $user->password = \Hash::make('abc123');
        $user->emp_id = $request->get('emp_id');


        $user->save();

        $user->attachRole(intval($request->get('role')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'table') {
            $users = User::with(array(
                    'employee' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'roles' => function ($query) {
                        $query->select('id', 'name');
                    })

            )
                ->get();

            return json_encode($users);
        }


        else if ($id == 'emp') {
            $emp = DB::table('employee')->get();
            return json_encode($emp);

        }

        else if ($id == 'doc') {
            $emp = Doctor::with(array(
                'emp' => function ($query) {
                    $query->select( 'name');
                }))->get();
            return json_encode($emp);

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->role = $request->get('role');
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
    }
}
