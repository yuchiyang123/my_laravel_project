<?php
namespace App\Http\Controllers;

use App\Models\UserPostMjoin;
use Illuminate\Http\Request;

class UserMjoinController extends Controller
{
    public function mjoin()
    {
        $mjoins = UserPostMjoin::all();

        return view('auth.front', compact('mjoins'));
    }

    public function showallmjoin($mjoinId)
    {
        $allmjoin = UserPostMjoin::where('id', $mjoinId)->get();

        return response()->json($allmjoin);
    }
}