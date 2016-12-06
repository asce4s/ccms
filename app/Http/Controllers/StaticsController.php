<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Sale;
use Illuminate\Http\Request;

use App\Http\Requests;

class StaticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:acc|admin']);
    }

    public function index(Request $request){

        if(isset($_GET["from"]) && isset($_GET["to"])) {

            $income=Sale::whereDate('created_at', '>=', $_GET["from"])
                ->whereDate('created_at', '<=', $_GET["to"])
                ->sum('price');

            $incomeData = Sale::whereDate('created_at', '>=', $_GET["from"])
                ->whereDate('created_at', '<=', $_GET["to"])
                ->select(\DB::raw('sum(price) as price, section'))
                ->groupBy('section')
                ->get();

            $expense = Expense::whereDate('created_at', '>=', $_GET["from"])
                ->whereDate('created_at', '<=', $_GET["to"])
                ->sum('cost');
            $expenseData = Expense::whereDate('created_at', '>=', $_GET["from"])
                ->whereDate('created_at', '<=', $_GET["to"])
                ->get();


            return view('admin.statics')
                ->with('income', $income)
                ->with('expense', $expense)
                ->with('idata',$incomeData);
        }else{
            return view('admin.statics');
        }
    }
}
