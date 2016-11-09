<?php

namespace App\Http\Controllers;


use App\Drug;
use App\LabItem;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getData(){
        $drug=Drug::whereRaw('qty <= minqty ')->get();

        $item=LabItem::whereRaw('qty <= minqty ')->get();

        $res=array();
        $res["drug"]=$drug;
        $res["item"]=$item;

        return json_encode($res);

    }

    public function getDrugData(){
        $drug=Drug::whereRaw('qty <= minqty ')->get();

        return json_encode($drug);

    }
    public function getItemData(){


        $item=LabItem::whereRaw('qty <= minqty ')->get();


        return json_encode($item);

    }

}