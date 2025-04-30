<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class AdminController extends Controller
{

    function login(Request $request){
      

      $validation= $request->validate([     //field validation 

        "name"=>"required",
        "password"=>"required",
      ]);
 
      $admin=Admin :: where([          
        ['name',"=",$request->name],
        ['password',"=",$request->password],
      ])->first();

      if(!$admin){

        $validation= $request->validate([    //validation for wrong input
          "user"=>"required",
        ],[

          "user.required"=>"User does not exist"
        ]);
      }

      Session::put('admin',$admin);   // made a session for admin inputs
       return redirect('dashboard');
    }


    function dashboard(){
      $admin= Session::get('admin');   //get admin data here from above 

      if($admin){
      return view('admin', ["name"=>$admin->name]);
      }else{
       return redirect('dashboard');

      }
    }
}
