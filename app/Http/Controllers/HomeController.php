<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Form_Diem;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function goStudents(Request $request){
        $data = Form_Diem::all();
        $user= $request->session()->get('user');

    }

    public function goToHome(Request $request)
    {
        // $user= $request->session()->get('user');
        // $sinhvien = $request->session()->get('sinhvien');
        if (isset(Auth::user()->id_role)) {
            switch (Auth::user()->id_role) {
                case '4':
                    return redirect()->route('listdiem');
                    break;
                case '3':
                    // $data = Form_Diem::all();
                    return redirect()->route('ViewUser');
                    break;
                case '2':
                    return redirect()->route('listdiem');
                case '1':
                    return redirect()->route('listdiem');
                // case 'null':
                //     return redirect()->route('login');
                //     break;
                // default:
                //     return redirect()->route('login');
                //     break;
            }
        }else{
            return redirect()->route('login');
        }
    }
}
