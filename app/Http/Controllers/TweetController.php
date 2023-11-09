<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function store(TweetRequest $request){
        $tweet = new Tweet();
        $tweet->user_id = Auth::id();
//        $tweet->content = $request->content;
    }
}
