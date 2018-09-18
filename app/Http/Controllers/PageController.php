<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Storage;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {
    public function index () {
        $data = Storage::get('sampledata.json');
        $data = json_decode($data, true);

        // return view('pages.index', compact('title'));
        return view('pages.index')->with('data', $data);
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