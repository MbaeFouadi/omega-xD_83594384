<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class pageController extends Controller
{
    //

    function choix(Request $request){

        if($request->input('choix')=='oui'){
            return view("recherche_auto");
        }
        else{

            $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date= $dt->format('Y-m-d');
            return view("choix_inscription",compact("s","date"));
        }
    }

    function inscription(Request $request){

        if($request->input('inscription')=='re-inscription'){
            $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date= $dt->format('Y-m-d');
            return view("re-inscription",compact("s","date"));
        }
        else if($request->input('inscription')=='nv_inscription'){

            $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date= $dt->format('Y-m-d');

            return view("inscription",compact("s","date"));
        }
        else{

            $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date= $dt->format('Y-m-d');
            $nin=Cookie::get('nin');
            $post=DB::table("post_inscription")->where("nin",$nin)->first();
            return view('index',compact('post','date','s'));
        }
    }

    
}
