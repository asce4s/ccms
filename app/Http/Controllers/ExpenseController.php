<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

use App\Http\Requests;

class ExpenseController extends Controller
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
        return view('admin.expense');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ex=new Expense();
        $ex->task=$request->get('task');
        $ex->cost=$request->get('cost');
        $ex->date=$request->get('date');
        $ex->save();

        $res["msg"]="Expense recorded";
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
        if ($id=='all'){
            return view('admin.expenseView');
        }else if ($id=='view'){
            $sale=Expense::whereDate('date', '>=',$_GET["from"])
                ->whereDate('date', '<=',$_GET["to"])
                ->get();



            return view('admin.expenseView')->with('data', $sale);
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
        $ex=Expense::find($id);
        $ex->task=$request->get('task');
        $ex->cost=$request->get('cost');
        $ex->date=$request->get('date');
        $ex->save();

        $res["msg"]="Expense record updated";
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
        //
    }
}
