<?php

namespace App\Http\Controllers;

use App\LabItem;
use App\LabSale;
use App\LabTest;
use App\LabTestSale;
use App\Sale;
use Illuminate\Http\Request;

use App\Http\Requests;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:lab|admin']);
    }


    public function index()
    {
        $tests=LabTest::all();
        return view('admin.labSale')
            ->with('tests',$tests);
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
        $data = json_decode($request->get('data'));
        $testData=json_decode($request->get('testData'));


        $sale = new Sale();
        $sale->section = "lab";
        $sale->price = $request->get('total');
        $sale->save();

        $sale_id = $sale->id;

        foreach ($data as $i) {

            $labsale = new LabSale();
            $labsale->item_id = $i->id;
            $labsale->qty = $i->quantity;
            $labsale->sale_id = $sale_id;
            $labsale->save();

            $item = LabItem::find($i->id);
            $item->qty = $i->qty;
            $item->save();

        }

        foreach ($testData as $i) {

            $labsale = new LabTestSale();
            $labsale->test_id = $i->id;
            $labsale->sale_id = $sale_id;
            $labsale->save();


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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'table') {
            $items=LabItem::all();

            return json_encode($items);
        } else if(strpos($id,'getsale')!==false){
            $sale=\DB::table("labsale")
                ->join('labitems', 'labsale.item_id', '=', 'labitems.id')
                ->join('brand', 'labitems.brand_id', '=', 'brand.id')
                ->where('labsale.sale_id',$_GET['id'])
                ->select('labitems.id', 'labitems.name','brand.name as brand','price','labsale.qty')
                ->get();

            $tstSale=\DB::table("labtestsale")
                ->join('labtest', 'labtestsale.test_id', '=', 'labtest.id')
                ->where('labtestsale.sale_id',$_GET['id'])
                ->select('labtest.id', 'labtest.name','price')
                ->get();

            $res=array();
            $res["sale"]=$sale;
            $res["test"]=$tstSale;


            return json_encode($res);
        }else {

            $sale=Sale::whereDate('created_at', '>=',$_GET["from"])
                ->whereDate('created_at', '<=',$_GET["to"])
                ->where('section','=','lab')
                ->get();


            return view('admin.labSalesview')->with('data', $sale);
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
        //
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
