<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StaticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:acc|admin']);
    }

    public function index(){
        return view('admin.statics');
    }
}
