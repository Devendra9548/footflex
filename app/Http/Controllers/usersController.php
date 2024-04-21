<?php

namespace App\Http\Controllers;
use App\Models\AdminInfo;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogSeo;
use App\Models\GlobalSeo;
use App\Models\category_blog_seo;
use App\Models\PageSeo;
use App\Models\customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ContactMail;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;



class usersController extends Controller
{
    function users(){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
        if(session()->has('cart')){
            return redirect('/checkout');
        }
        else{
            return redirect('/dashboard');
        }
      }
      else{
        $pageseo = PageSeo::where('slug', 'login')->get();
        $homepageseo = PageSeo::where('slug', 'login')->get();
        $gseo = GlobalSeo::find(1);
        return view('users.user', ['pageseo'=>$pageseo,'gseo'=>$gseo,'homepageseo'=>$homepageseo]);
    }
    }

    function logout(){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
          session()->pull('cusername', null);
          session()->pull('cemail', null);
          session()->pull('cpassword', null);
          return redirect('/login');
      }
    }

    function checklogin(Request $req){
      try {
          $dbs = customer::where('password', $req->password)->first();
  
          if ($dbs && ($req->password == $dbs->password && ($req->username == $dbs->username || $req->username == $dbs->email))) {
              session()->put('cusername', $req->username);
              session()->put('cemail', $req->username);
              session()->put('cpassword', $req->password);
              return true;
          } else {
              return "Incorrect Username & Password";
          }
      } catch (QueryException $e) {
          // Log the exception or handle it in any other way
          // For example:
          return "Error: Unable to perform database query";
      }
  }

    function wpaddusers(Request $req){
        $dbs = new customer();
        $username = $req->input('username');
        $email = $req->input('email');
        $password = $req->input('password');

        $dbs->username = $username;
        $dbs->email = $email;
        $dbs->p_number = $req->input('phonenumber');
        $dbs->password = $password;
        $result = $dbs->save();
        session()->put('cusername', $username);
        session()->put('cemail', $email);
        session()->put('cpassword', $password);
        if($result){
          return true;
        }
        else{
          return false;
        }
    }

    function dashboard(){
    if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
    {
        $username = session('cusername');
        $password = session('cpassword');
        $userid = customer::where('username', $username)
        ->where('password', $password)
        ->get();

        $customer = customer::find($userid[0]->id);
              
        $orders = DB::table('orders')
        ->join('customers', 'orders.userid', '=', 'customers.id')
        ->where('customers.id', $userid[0]->id)
        ->get();
        
        $pageseo = PageSeo::where('slug', 'login')->get();
        $homepageseo = PageSeo::where('slug', 'login')->get();
        $gseo = GlobalSeo::find(1);
        return view('users.dashboard',['pageseo'=>$pageseo,'gseo'=>$gseo,'homepageseo'=>$homepageseo, 'orders'=>$orders,'customer'=>$customer]);
    }
    else{
        return redirect('/login');
    }
    }

    function purchased(Request $req){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
      $dbs = new Order();
      $dbs->userid = $req->userid;
      $t=time();
      $d=date("Ymd",$t);
      $dbs->orderid = $d."".$t;
      $dbs->firstname = $req->firstname;
      $dbs->lastname = $req->lastname;
      $dbs->email = $req->email;
      $dbs->phonenumber = $req->phone;
      $dbs->address = $req->address;
      $dbs->altaddress = $req->altaddress;
      $dbs->country = $req->country;
      $dbs->state = $req->state;
      $dbs->zip = $req->zip;
      $dbs->paymethod = $req->paymentmethod;
      $dbs->cart = $req->cart;
      $dbs->amount = $req->amount;
      $dbs->status = $req->status;
      $result = $dbs->save();
      if($result){
        session()->pull('cart', null);
        return true;
      }
      else{
        return false;
      }
    }
    else{
      return redirect('/login');
    }
    }

    function getorder($id){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
       $orderid = Order::where('orderid', $id)->get();
       
       $pageseo = PageSeo::where('slug', 'login')->get();
        $homepageseo = PageSeo::where('slug', 'login')->get();
        $gseo = GlobalSeo::find(1);
        return view('users.orderhistory',['pageseo'=>$pageseo,'gseo'=>$gseo,'homepageseo'=>$homepageseo, 'orders'=>$orderid]);
      }
      else{
          return redirect('/login');
      }

    }

    function userupdate(Request $req){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
        $dbs = customer::find($req->id);
        $dbs->username = $req->username;
        $email = $req->email;
        $dbs->email = $email;
        $dbs->p_number = $req->phone;
        $password = $req->pswd;
        $dbs->password = $password;
        $result = $dbs->save();
        if($result){ 
        session()->put('cemail', $email);
        session()->put('cpassword', $password);
          return true;
        }
        else{
          return false;
        }
         
      }
      else{
        return redirect('/login');
      }
    }

    function deletegetorder($id){
      if((session()->has('cusername') || session()->has('cemail')) && session()->has('cpassword'))
      {
          $order = Order::where('orderid', $id)->first();
          if($order){
              $order->delete();
              return true;
          }
          else{
              return false;
          }
      }
      else{
          return redirect('admin');
      }
  }
  

}
