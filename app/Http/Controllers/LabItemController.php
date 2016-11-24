<?php

namespace App\Http\Controllers;

use App\LabItem;
use Illuminate\Http\Request;

use App\Http\Requests;

class LabItemController extends Controller
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
        return view('admin.labItem');
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
        $item = new LabItem();
        $item->name = $request->get('name');
        $item->price = $request->get('price');
        $item->brand_id = $request->get('brand_id');
        $item->qty = $request->get('qty');
        $item->itemcode = $request->get('itemcode');
        $item->minqty = $request->get('minqty');
        $item->save();
        $res = array();
        $res["msg"] = "Item Added";
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
        if($id=='table'){
            $drug=LabItem::with(array(
                'brand' => function ($query) {
                    $query->select('id', 'name');
                }))->get();



            return json_encode($drug);
        }
        else if($id=='all'){
            $data = \DB::table('labitems')
                ->join('brand', 'labitems.brand_id', '=', 'brand.id')
                ->select('labitems.itemcode', 'labitems.name','brand.name as brand','price','qty','labitems.id')
                ->get();
            $cols=array("Item Code","Name","Brand","Price (Rs)","quantity");



            return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Lab Items')
                ->with('url','labitems');
        }


        else if(strpos($id,'getsale')!==false){
            $sale=\DB::table("drugsale")
                ->join('drug', 'drugsale.drug_id', '=', 'drug.id')
                ->join('brand', 'drug.brand_id', '=', 'brand.id')
                ->where('drugsale.saleid',$_GET['id'])
                ->select('drug.id', 'drug.name','brand.name as brand','price','drugsale.qty')
                ->get();


            return json_encode($sale);
        }

        else{

            $data = \DB::table('labitems')
                ->join('brand', 'labitems.brand_id', '=', 'brand.id')
                ->select('labitems.itemcode', 'labitems.name as dn','brand.name','price','qty')
                ->first();
            $cols=array("Item Code","Name","Brand","Unit price","Remaining quantity");

            return view('admin.singleview')
                ->with('data',(array)$data)
                ->with('cols',$cols)
                ->with('title','Item #'.$id);


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
        $h=LabItem::findorfail($id);
        return view('admin.labitem')
            ->with('data',$h);
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
        $item = LabItem::find($id);
        $item->name = $request->get('name');
        $item->price = $request->get('price');
        $item->brand_id = $request->get('brand_id');
        $item->qty = $request->get('qty');
        $item->itemcode = $request->get('itemcode');
        $item->minqty = $request->get('minqty');
        $item->save();
        $res = array();
        $res["msg"] = "Item Updated";
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
        $item = LabItem::find($id);
        $item->delete();
    }
}
