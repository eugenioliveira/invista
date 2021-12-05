<?php

namespace App\Http\Controllers;


use App\Models\Allotment;
use App\Models\Map;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function show(Map $map)
    {
        return view('maps.show', ['map' => $map]);
    }

    public function edit(Allotment $allotment)
    {
        return view('maps.edit', ['allotment' => $allotment]);
    }
}
