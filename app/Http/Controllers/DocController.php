<?php

namespace App\Http\Controllers;

use App\Employee;
use DB;
use App\Doctor;
use Illuminate\Http\Request;

use App\Http\Requests;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:doc|admin']);
    }

    public function index()
    {
        return view('admin.doc');
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


        $emp = new Employee();
        $emp->name = $request->get('name');
        $emp->nic = $request->get('nic');
        $emp->designation = 'Doctor';
        $emp->addr = $request->get('addr');
        $emp->save();

        $doc = new Doctor();
        $doc->emp_id = $emp->id;
        $doc->qualifications = $request->get('qualifications');
        $doc->specializedIn = $request->get('specializedIn');
        $doc->phone = $request->get('phone');
        $doc->email = $request->get('email');
        $doc->save();

        $res = array();
        $res["msg"] = "Doctor Added";
        $res["class"] = "alert-success";
        $res["stat"] = true;

        return json_encode($res);


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

            /*$doc=Doctor::with(array(
                'emp' => function ($query) {
                    $query->select('id', 'name','nic');
                }))->get();*/

                $doc = DB::table('doctor')
                    ->join('employee', 'doctor.emp_id', '=', 'employee.id')
                    ->select('doctor.id', 'employee.name', 'employee.nic', 'qualifications', 'specializedIn', 'phone', 'email','addr')
                    ->get();
            return json_encode($doc);
        }
        else if ($id == 'all') {
            $data = DB::table('doctor')
                ->join('employee', 'doctor.emp_id', '=', 'employee.id')
                ->select('doctor.id', 'employee.name', 'employee.nic', 'qualifications', 'specializedIn', 'phone', 'email')
                ->get();
            $cols = array("ID", "Name", "NIC", "Qualifications", "Specialized In", "Phone", "Email");

            return view('admin.view')
                ->with('data', $data)
                ->with('cols', $cols)
                ->with('title', 'Doctors')
                ->with('url','doc');
        }else{
            $data = DB::table('doctor')
                ->join('employee', 'doctor.emp_id', '=', 'employee.id')
                ->select('doctor.id', 'employee.name', 'employee.nic', 'qualifications', 'specializedIn', 'phone', 'email','addr')
                ->where('doctor.id',$id)
                ->first();
            $cols = array("ID", "Name", "NIC", "Qualifications", "Specialized In", "Phone", "Email","Address");

            return view('admin.singleView')
                ->with('data', (array)$data)
                ->with('cols', $cols)
                ->with('title', 'Doctor #'.$id);

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
        $data = DB::table('doctor')
            ->join('employee', 'doctor.emp_id', '=', 'employee.id')
            ->select('doctor.id', 'employee.name', 'employee.nic', 'qualifications', 'specializedIn', 'phone', 'email','addr')
            ->where('doctor.id',$id)
            ->first();
        return view('admin.doc')
            ->with('data',json_encode($data));
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
        $doc = Doctor::find($id);
        $doc->name = $request->get('name');
        $doc->nic = $request->get('nic');
        $doc->qualifications = $request->get('qualifications');
        $doc->specializedIn = $request->get('specializedIn');
        $doc->phone = $request->get('phone');
        $doc->email = $request->get('email');
        $doc->save();

        $res = array();
        $res["msg"] = "Doctor Updated";
        $res["class"] = "alert-success";
        $res["stat"] = true;

        return json_encode($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('doctor')->where('id', '=', $id)->delete();
        $res = array();
        $res["msg"] = "Doctor Deleted";
        $res["class"] = "alert-success";
        $res["stat"] = true;

        return json_encode($res);
    }
}
