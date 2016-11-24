<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\History;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:doc']);
    }


    public function index()
    {
        $p=Patient::all();
        return view('admin.history')->with("patients",$p);
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

        $doc_id=Doctor::where('emp_id',Auth::user()->emp_id)->first()->id;
        $h=new History();
        $h->patient_id=$request->get('patient_id');
        $h->doc_id=$doc_id;
        $h->date=$request->get('date');
        $h->prescription=$request->get('prescription');
        $h->note=$request->get('note');
        $h->save();

        $res=array();
        $res["msg"]="Record Added";
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
        $cols=array("ID","Name","Date","Prescription","Note");
        if($id=='all'){
            $data = \DB::table('medicalhistory')
                ->join('patient','medicalhistory.patient_id','=','patient.id')
                ->select('medicalhistory.id','patient.name' ,'date','prescription','note')
                ->where('doc_id',$doc_id=Doctor::where('emp_id',Auth::user()->emp_id)->first()->id)
                ->get();


            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Medical Records')
                ->with('url','history');
        }else{
            $data = \DB::table('medicalhistory')
                ->join('patient','medicalhistory.patient_id','=','patient.id')
                ->select('medicalhistory.id','patient.name' ,'date','prescription','note')
                ->where('medicalhistory.id',$id)
                ->first();

            $data=(array)$data;

            $subData=\DB::table('patient')
                ->select('name','gender','nic','addr','phone','dob')
                ->where('id',History::find($id)->patient_id)
                ->first();

            $subData=(array)$subData;

            $subTitles=array('Name','Gender','NIC','Address','Phone','Date of birth');

            return view('admin.singleview')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Record #'.$id)
                ->with('sub','admin.partials.patient_info')
                ->with('subData',$subData)
                ->with('subTitles',$subTitles);
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
        $p=Patient::all();
        $h=History::findorfail($id);
        return view('admin.history')->with("patients",$p)
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

        $h=History::findorfail($id);
        $h->patient_id=$request->get('patient_id');
        $h->prescription=$request->get('prescription');
        $h->date=$request->get('date');
        $h->note=$request->get('note');
        $h->save();

        $res=array();
        $res["msg"]="Record Updated";
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
        History::findorfail($id)->delete();
        $res=array();
        $res["msg"]="Record Deleted";
        $res["class"]="alert-success";
        $res["stat"]=true;
    }
}
