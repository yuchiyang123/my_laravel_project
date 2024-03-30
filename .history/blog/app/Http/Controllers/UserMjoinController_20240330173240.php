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
        $allmjoin = UserPostMjoin::where('id', $mjoinId)->first();

        $htmlContent = '
        <div class="mid">
            <div class="cut">
                <div class="grid-item">
                    <div class="limt">
                        <div class="image-container">
                            <img src="img/2-1.png" class="imgsize">
                        </div>
                        <div class="text-container">
                            <div class="user"><a href="#">
                                <div><a href="#">你的名字</a></div>
                            </a></div>
                            <div class="date">
                                <div><a href="#">日期</a></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <p class="main">
                            '.$allmjoin->title.'
                            '.$allmjoin->description.'
                            ...
                            // 其他数据字段
                        </p>
                        // 其他 HTML 结构
                    </div>
                </div>
            </div>
        </div>';

        //return response()->json($allmjoin);

        return response()->json(['htmlContent' => $htmlContent]);
    }
}