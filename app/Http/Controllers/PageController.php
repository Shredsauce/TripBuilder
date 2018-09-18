<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller {
    public function index () {
    	$title = "Trip Builder";

        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function services() {
    	$data = array (
    		'title' => 'Services',
    		'services' => ['Blah', 'blah2', 'blah 3']
    	);
    	return view('pages.services')->with($data);
    }

}