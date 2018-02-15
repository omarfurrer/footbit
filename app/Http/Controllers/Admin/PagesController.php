<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller {

    /**
     * Display Admin dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

}
