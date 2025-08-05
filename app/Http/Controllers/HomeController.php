<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lastestblog = Blog::latest()->take(3)->get();

        return view('posts.index', compact('lastestblog'));
    }
}
