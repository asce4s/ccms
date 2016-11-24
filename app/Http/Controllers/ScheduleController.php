<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Schedule;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpParser\Comment\Doc;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:rec|admin']);
    }


    public function index()
    {
        $doc=Doctor::with(
            array('emp'=>function($query){
                $query->select('id','name');
            }))->get();


        return view('admin.schedule')->with("doc",$doc);
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



        $sc=new Schedule();
        $sc->doc_id=$request->get('doc_id');
        $sc->weekday=$request->get('weekday');
        $sc->fromTime=$request->get('fromTime');
        $sc->toTime=$request->get('toTime');
        $sc->description=$request->get('description');
        $sc->max=$request->get('max');
        $sc->save();

        $res=array();
        $res["msg"]="Schedule Added";
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
            $sc =Schedule::with(array(
                'doctor' => function ($query) {
                    $query->join('employee','employee.id','doctor.emp_id');
                    $query->select('doctor.id', 'employee.name');

                }))->get();
            return json_encode($sc);
        }

        if($id=='all'){
            $data = \DB::table('schedule')
                ->select('id', 'doc_id','weekday','fromTime','toTime','description')
                ->get();
            $cols=array("ID","Doctor","Day","From","To","Description");

            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','View Patients');
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
        //
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
        $sc=Schedule::find($id);
        $sc->doc_id=$request->get('doc_id');
        $sc->weekday=$request->get('weekday');
        $sc->fromTime=$request->get('fromTime');
        $sc->toTime=$request->get('toTime');
        $sc->description=$request->get('description');
        $sc->save();

        $res=array();
        $res["msg"]="Schedule Updated";
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
        try {
            \DB::table('schedule')->where('id', '=', $id)->delete();
        }catch (\Exception $e){
            echo $e;
        }
        $res=array();
        $res["msg"]="Schedule Deleted";
        $res["class"]="alert-success";
        $res["stat"]=true;

        return json_encode($res);
    }
}
