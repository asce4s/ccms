<?php

namespace App\Http\Controllers\Auth;

use Dotenv\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function index(){
        return view('auth.passwords.set');
    }

    public function change(Request $request){
        $user=Auth::user();


        if(Hash::check( $request->get('cpw'), $user->password )) {


            $user->password=Hash::make($request->get('npw'));
            $user->save();

            $msg=array(
                'msg'=>'Password changed',
                'class'=>'alert-success',
                'stat'=> true
            );

            return json_encode($msg);

           /* $rules = array(
                cpw=>'required',
                npw=>'required',
                ncpw=>'required|same:npw',

            );

            $val=Validator::make(Input::all(),$rules);
            if($val->fails()){
                $msg=array(
                    'msg'=>'Confirm password doesn \'t match',
                    'class'=>'alert-danger',
                    'stat'=> true
                );

                return json_encode($msg);
            }else{
                return "dsgd";
            }*/
        }else{
            $msg=array(
                'msg'=>'Your current password doesn \'t match',
                'class'=>'alert-danger',
                'stat'=> true
            );

            return json_encode($msg);
        }

       /* */


    }
}
