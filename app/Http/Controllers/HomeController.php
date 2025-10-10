<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.home');
    }
    public function pricing()
    {
        return view('user.pricing');
    }
    public function faqs()
    {
        return view('user.faqs');
    }
    public function blog()
    {
        return view('user.blog');
    }
    public function blogDetails()
    {
        return view('user.blog_details');
    }
}
