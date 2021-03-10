<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function index() {
        return view('home', ['items' => Item::all()]);
    }
}
