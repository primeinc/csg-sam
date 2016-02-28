<?php

namespace App\Http\Controllers\Frontend\Asset;

use App\Models\Asset;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{

    public function index() {
        $assets = Asset::orderBy('created_at', 'desc')->with('Mfr')->get();

        return view('frontend.assets', compact('assets'));
    }
}
