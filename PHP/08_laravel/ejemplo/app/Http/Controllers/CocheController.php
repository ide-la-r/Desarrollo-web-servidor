<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index () {
        $coches = [
            ["RX7", "Mazda", 20000],
            ["CLA", "Mercedes", 30000],
            ["Mustang", "Ford", 45000],
            ["307 MS", "Peugeot", 15000],
            ["Multipla", "Fiat", 15000],
            ["C3", "Citroen", 17000],
            ["Pajero","Mitshubishi", 20000]
        ];
        return view('coches', ['coches' => $coches]);
    }
}
