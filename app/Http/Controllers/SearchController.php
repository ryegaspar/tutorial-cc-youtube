<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->q) {
            return redirect('/');
        }

        $channels = Channel::search($request->q)->take(2)->get();

        return view('search.index', compact('channels'));
    }
}
