<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Drug;
use Illuminate\Http\Request;

use App\Http\Requests;

class DrugController extends Controller
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
        return view('admin.drugs');
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
        $drug=new Drug();
        $drug->name=$request->get('name');
        $drug->price=$request->get('price');
        $drug->description=$request->get('description');
        $drug->brand_id=$request->get('brand_id');
        $drug->qty=$request->get('qty');
        $drug->itemcode=$request->get('itemcode');
        $drug->minqty=$request->get('minqty');
        $drug->save();
        $res=array();
        $res["msg"]="Drug Added";
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
        if($id=='table'){
            $drug=Drug::with(array(
                'brand' => function ($query) {
                    $query->select('id', 'name');
                }))->get();



            return json_encode($drug);
        }
        else if($id=='all'){
            $data = \DB::table('drug')
                ->join('brand', 'drug.brand_id', '=', 'brand.id')
                ->select('drug.itemcode', 'drug.name','description','brand.name','price','qty','drug.id')
                ->get();
            $cols=array("ID","Name","Description","Price","quantity");



           return view('admin.view')
                ->with('data',$data)
                ->with('cols',$cols)
                ->with('title','Medicines')
               ->with('url','drug');
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

            $data = \DB::table('drug')
                ->join('brand', 'drug.brand_id', '=', 'brand.id')
                ->select('drug.itemcode', 'drug.name as dn','brand.name','description','price','qty')
                ->first();
            $cols=array("Drug Code","Name","Brand","Description","Unit price","Remaining quantity");

            return view('admin.singleview')
                ->with('data',(array)$data)
                ->with('cols',$cols)
                ->with('title','Drug #'.$id);


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
        $h=Drug::findorfail($id);
        return view('admin.drugs')
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
        $drug=Drug::find($id);
        $drug->name=$request->get('name');
        $drug->price=$request->get('price');
        $drug->description=$request->get('description');
        $drug->brand_id=$request->get('brand_id');
        $drug->qty=$request->get('qty');
        $drug->itemcode=$request->get('itemcode');
        $drug->minqty=$request->get('minqty');
        $drug->save();
        $res=array();
        $res["msg"]="Drug Updated";
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
        $drug=Drug::find($id);
        $drug->delete();
    }
}
