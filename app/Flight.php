<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model {
    protected $table = 'flights';
    public $primaryKey = 'id';

    public function flights() {

        $flights = DB::table('flights')->get();
        return view ('pages.services')->with('flights', $flights); 
    }

}
