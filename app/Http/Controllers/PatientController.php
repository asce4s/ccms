<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:doc|admin|rec']);
    }


    public function index()
    {
        return view('admin.patients');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $patient=new Patient();
        $patient->name=$request->get('name');
        $patient->nic=$request->get('nic');
        $patient->dob=$request->get('dob');
        $patient->addr=$request->get('addr');
        $patient->phone=$request->get('phone');
        $patient->gender=$request->get('gender');
       $patient->save();

        $res=array();
        $res["msg"]="Patient Added";
        $res["class"]="alert-success";
        $res["stat"]=true;

        return json_encode($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'table') {
            $emp = \DB::table('patient')->get();
            return json_encode($emp);
        }

        else if($id=='all'){
            $data = \DB::table('patient')
                ->select('id', 'name','gender','nic','phone','addr')
                ->get();
            $cols=array("ID","Name","Gender","NIC","Phone","Address");

            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','View Patients')
                ->with('url','patient');
        }else{
            $data = \DB::table('patient')
                ->select('id', 'name','gender','nic','phone','addr')
                ->where('id',$id)
                ->first();
            $cols=array("ID","Name","Gender","NIC","Phone","Address");

            return view('admin.singlePatientView')
                ->with('data',(array)$data)
                ->with('cols',$cols)
                ->with('title','Patient #'.$id);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $h=Patient::findorfail($id);
        return view('admin.patients')
            ->with('data',$h);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient=Patient::find($id);
        $patient->name=$request->get('name');
        $patient->nic=$request->get('nic');
        $patient->dob=$request->get('dob');
        $patient->addr=$request->get('addr');
        $patient->phone=$request->get('phone');
        $patient->gender=$request->get('gender');
        $patient->save();

        $res=array();
        $res["msg"]="Patient Updated";
        $res["class"]="alert-success";
        $res["stat"]=true;

        return json_encode($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient=Patient::find($id);
        $patient->delete();
        $res=array();
        $res["msg"]="Patient Deleted";
        $res["class"]="alert-success";
        $res["stat"]=true;

        return json_encode($res);
    }
}
