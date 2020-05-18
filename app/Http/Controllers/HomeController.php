<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param UserRepository $users
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserRepository $users)
    {
        dd($users->videosFromSubscriptions(request()->user()));
        return view('home');
    }
}
