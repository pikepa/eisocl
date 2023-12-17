<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply){
       return $reply->favorite();
    }
}
