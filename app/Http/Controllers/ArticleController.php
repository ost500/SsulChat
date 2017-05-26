<?php

namespace App\Http\Controllers;
use App\Article;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show()
    {
        $article = Article::with('hashtag')->with('user')->get();
        return view('welcome', compact('article'));
    }
}
