<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Sale;
use App\Schedule;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Role;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:rec|admin']);
    }


    public function index()
    {
        $sc = Schedule::with(array(
            'doctor' => function ($query) {
                $query->join('employee', 'employee.id', 'doctor.emp_id');
                $query->select('doctor.id', 'employee.name');
            }))->get();
        return view('admin.booking')->with("sc", $sc);
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



        $token = \DB::table('booking')
            ->select(DB::raw(' max(token) as mx'))
            ->where("schedule_id", '=', $request->get('schedule_id'))
            ->where('date', '=', $request->get('date'))
            ->groupBy('schedule_id')
            ->first();


        $maxP = Schedule::find($request->get('schedule_id'))->first(['max']);


        if ($token) {
            $max = intval($token->mx) + 1;
        } else {
            $max = 1;
        }

        if (intval($maxP->max) >= $max) {

            /*  \DB::table('booking')->insert(
                  [
                      'name' => $request->get('name'),
                      'nic' => $request->get('nic'),
                      'schedule_id' => intval($request->get('schedule_id')),
                      'phone' => $request->get('phone'),
                      'date' => $request->get('date'),

                      'token' => $max
                  ]

              );*/


            $bk = new Booking();
            $bk->name = $request->get('name');
            $bk->nic = $request->get('nic');
            $bk->schedule_id = intval($request->get('schedule_id'));
            $bk->phone = $request->get('phone');
            $bk->date = $request->get('date');
            $bk->token = $max;
            $bk->save();

            $res = array();
            $res["msg"] = "Booking Added with token " . $max;
            $res["class"] = "alert-success";
            $res["stat"] = true;
        } else {
            $res = array();
            $res["msg"] = "Sorry quota is filled ";
            $res["class"] = "alert-danger";
            $res["stat"] = true;
        }
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
        if ($id = "view") {
            if (isset($_GET["date"])) {
                $date = $_GET["date"];
            } else {
                $date = Carbon::now()->toDateString();
            }
            $bookings = \DB::table('booking')
                ->join('schedule', 'schedule.id', 'booking.schedule_id')
                ->join('doctor', 'doctor.id', 'schedule.doc_id')
                ->join('employee', 'employee.id', 'doctor.emp_id')
                ->select('booking.name', 'booking.phone', 'booking.nic', 'employee.name as doc', 'fromTime', 'toTime', 'token','sale_id','booking.id','schedule.fee')
                ->where('date', '=', $date)
                ->get();


            return view('admin.bookingView')->with("bookings", $bookings);
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

        if(!isset($_GET["pay"])) {
            $bk = Booking::find($id);
            $bk->name = $request->get('name');
            $bk->nic = $request->get('nic');
            $bk->schedule_id = $request->get('schedule_id');
            $bk->phone = $request->get('phone');
            $bk->date = $request->get('date');
            $bk->save();
            $res = array();
            $res["msg"] = "Booking Added";
            $res["class"] = "alert-success";
            $res["stat"] = true;

            return json_encode($res);
        }else{
            $sale = new Sale();
            $sale->section = "Channeling";
            $sale->price = $request->get('fee');
            $sale->save();

            $bk = Booking::find($id);
            $bk->sale_id=$sale->id;
            $bk->save();

            return "true";

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('booking')->where('id', '=', $id)->delete();
        $res = array();
        $res["msg"] = "Schedule Deleted";
        $res["class"] = "alert-success";
        $res["stat"] = true;

        return json_encode($res);
    }
}
