<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

use App\Http\Requests;

class WebController extends Controller
{
    public function index(){
        $doc=Doctor::with(
            array('emp'=>function($query){
                $query->select('id','name');
            }))->get();


        return view('web.web')->with("doc",$doc);

    }
}
