<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index(){
        $menus = Menu::all();
        $makanan = $menus->where('type', 'makanan');
        $minuman = $menus->where('type', 'minuman');

        return view('index', compact('makanan', 'minuman'));
    }
}
