<?php

namespace App\Http\Controllers\folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Connection;
use App\Models\City;

class MainController extends Controller
{
    public function index() {
        $people = Person :: all();
        // dd($people);
        return view("people.index", compact('people'));
    }
    public function show($id) {
        $person = Person :: find($id);
        // dd($person);
        return view("people.show", compact('person'));
    }
}
