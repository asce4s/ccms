<?php

namespace App\Http\Controllers;

use App\Drug;
use App\DrugSale;
use App\Sale;
use Dotenv\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class DrugSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:phm|admin|acc']);
    }

    public function index()
    {
        return view('admin.drugSale');
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

        $data = json_decode($request->get('data'));


        $sale = new Sale();
        $sale->section = "pharmacy";
        $sale->price = $request->get('total');
        $sale->save();

        $sale_id = $sale->id;

        foreach ($data as $i) {

            $drugsale = new DrugSale();
            $drugsale->drug_id = $i->id;
            $drugsale->qty = $i->quantity;
            $drugsale->saleId = $sale_id;
            $drugsale->save();

            $drug = Drug::find($i->id);
            $drug->qty = $i->qty;
            $drug->save();

        }

        $res = array();
        $res["msg"] = "Sale Completed";
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
            $drug = Drug::with(array(
                'brand' => function ($query) {
                    $query->select('id', 'name');
                }))->get();

            return json_encode($drug);
        } else {

            $sale=Sale::whereDate('created_at', '>=',$_GET["from"])
                ->whereDate('created_at', '<=',$_GET["to"])
                ->where('section','=','pharmacy')
                ->get();


            return view('admin.drugSalesview')->with('data', $sale);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
