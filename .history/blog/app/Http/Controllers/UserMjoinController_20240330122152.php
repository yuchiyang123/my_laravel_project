<?php
namespace App\Http\Controllers;

use App\Models\UserPostMjoin;
use Illuminate\Http\Request;

class UserMjoinController extends Controller
{
    public function mjoin()
    {
        $mjoins = UserPostMjoin::all();

        return view('front', compact('mjoins'));
    }
}