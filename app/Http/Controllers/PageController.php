<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {
    public function index () {
        return view('pages.index');
    }

    public function services() {
        // $flights = DB::table('flights')->where('airline', 'AC');
        // return view('pages.services', ['flights' => $flights]);


        $flights = DB::table('flights')->get();
        return view ('pages.services')->with('flights', $flights); 

        // $flights = DB::table('flights')->get();
        // return view('pages.services', ['flights' => $flights]);
    }

    // public function services() {
    // 	$data = array (
    // 		'title' => 'Services',
    // 		'services' => ['Blah', 'blah2', 'blah 3']
    // 	);
    // 	return view('pages.services')->with($data);
    // }

}