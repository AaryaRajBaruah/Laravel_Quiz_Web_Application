<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;

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
      $admin= Session::get('admin');   //get admin data here from above session

      if($admin){
      return view('admin', ["name"=>$admin->name]);
      }else{
       return redirect('admin-login');

      }
    } 


    function categories(){

      $categories= Category::get();
      $admin= Session::get('admin');   //get admin data here from above session

      if($admin){
      return view('categories', ["name"=>$admin->name,"categories"=>$categories]);
      }else{
       return redirect('admin-login');

      }
    } 


    function logout(){
      Session::forget('admin');       //delete session of the user 
      return redirect ('admin-login');
    }


    function addcategory(Request $request){
      $validation=$request->validate([
        "category"=>"required | min:3 |unique:categories,name"
      ]);

      $admin= Session::get('admin');
      $category= new Category();
      $category->name=$request->category;
      $category->creator=$admin->name;

      if($category->save()){
        Session::flash('category', "Success: Category " . $request->category . " Added.");        //session category is made
      }
        return redirect('admin-categories');

    }


    function deletecategory($id){

      $isDeleted= Category::fing($id)->delete();
      if($isDelete){
        Session::flash('category', "Success: Category " . $request->category . " Added."); 
      }

    }

    function addQuiz(){
       
      $admin= Session::get('admin');   //get admin data here from above session
      $categories=Category::get();
      if($admin){
        $quizName=request('quiz') ;    
        $category_id=request('category_id') ;    

        if($quizName && $category_id && !Session::has('quizDetails')){   //!SEssion will check if this key is not present then it will save if present then it will not save it again
          $quiz=new Quiz();
          $quiz->name=$quizName;
          $quiz->category_id=$category_id;
          if($quiz->save()){
            Session::put('quizDetails',$quiz);
          }
        }
        
        return view('add-quiz', ["name"=>$admin->name,"categories"=>$categories]);
      }else{
       return redirect('admin-login');

      }
    }

             
 

}
