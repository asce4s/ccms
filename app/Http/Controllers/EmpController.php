<?php

namespace App\Http\Controllers;

use DB;
use App\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\Console\Input\Input;

class EmpController extends Controller
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
        return view('admin.emp');
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
        $emp->designation = $request->get('designation');
        $emp->addr = $request->get('addr');
        $emp->save();
        $res=array();
        $res["msg"]="Employee Added";
        $res["class"]="alert-success";
        $res["stat"]=true;

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
            $emp = DB::table('employee')->get();
            return json_encode($emp);
        }

        else if($id=='all'){
            $data = DB::table('employee')
                ->select('id', 'name','nic','designation','addr')
                ->get();
            $cols=array("ID","Name","NIC","Designation","Address");

            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Employees')
                ->with('url','emp');
        }else{
            $data = DB::table('employee')
                ->select('id', 'name','nic','designation','addr')
                ->where('id',$id)
                ->first();
            $cols=array("ID","Name","NIC","Designation","Address");

            return view('admin.singleview')
                ->with('data',(array)$data)
                ->with('cols',$cols)
                ->with('title','#Employee '.$id);
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
        $d=Employee::findorfail($id);
        return view('admin.emp')
            ->with('data',$d);
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
        $emp = Employee::find($id);
        $emp->name = $request->get('name');
        $emp->nic = $request->get('nic');
        $emp->designation = $request->get('designation');
        $emp->addr = $request->get('addr');
        $emp->save();

        $res=array();
        $res["msg"]="Employee Updated";
        $res["class"]="alert-success";
        $res["stat"]=true;

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
        DB::table('employee')->where('id', '=', $id)->delete();
        $res=array();
        $res["msg"]="Employee Deleted";
        $res["class"]="alert-success";
        $res["stat"]=true;

        return json_encode($res);
    }
}
