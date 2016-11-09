<?php

namespace App\Http\Controllers;

use App\LabTest;
use Illuminate\Http\Request;

use App\Http\Requests;

class LabTestController extends Controller
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
        return view('admin.labTest');
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
        $tst=new LabTest();
        $tst->name=$request->get('name');
        $tst->price=$request->get('price');
        $tst->save();

        $res = array();
        $res["msg"] = "Test added";
        $res["class"] = "alert-success";
        $res["stat"] = true;

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
        if($id=='table'){
            $tst=LabTest::all();
            return json_encode($tst);
        }
        else if($id=='all'){
            $data = \DB::table('labtest')
                ->select('id', 'name','price')
                ->get();
            $cols=array("ID","Name","Price");



            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Lab Tests')
                ->with('url','labtest');
        }

        else{

            $data = \DB::table('labtest')
                ->select('id', 'name','price')
                ->where('id',$id)
                ->first();
            $cols=array("ID","Name","Price");

            return view('admin.singleview')
                ->with('data',(array)$data)
                ->with('cols',$cols)
                ->with('title','Test #'.$id);


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
        $h=LabTest::findorfail($id);
        return view('admin.labTest')
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
        $tst=LabTest::find($id);
        $tst->name=$request->get('name');
        $tst->price=$request->get('price');
        $tst->save();

        $res = array();
        $res["msg"] = "Test updated";
        $res["class"] = "alert-success";
        $res["stat"] = true;

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
        $tst=LabTest::find($id);
        $tst->delete();
        $res = array();
        $res["msg"] = "Test deleted";
        $res["class"] = "alert-success";
        $res["stat"] = true;

        return json_encode($res);
    }
}
