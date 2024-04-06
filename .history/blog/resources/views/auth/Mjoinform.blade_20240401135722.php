@extends('layouts.frontpage')
@section('title', '')

@section('condition_add')

@section('Post')
<div class="cut">
    <div class="grid-item">
        <div class="limt">

<div>
                            <label class="post-title-label">標題:</label>
                            <input type="text" class="posts-title" name="title" required>
</div>
                        <label class="post-title-label2">目的:</label>
                        <!--input type="text" class="posts-title" name="destination" required-->
                        <select id="selectwhere" name="destination" required>
                            <option value="臺北市">臺北市</option>
                            <option value="新北市">新北市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="臺中市">臺中市</option>
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="屏東縣">屏東縣</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="臺東縣">臺東縣</option>
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="連江縣">連江縣</option>
                            <option value="基隆市">基隆市</option>
                            <option value="新竹市">新竹市</option>
                            <option value="嘉義市">嘉義市</option>
                        </select>
</div>
                        <div>
                            <label class="post-title-label">時間:</label>
</div>
                        <div>
                            <label class="post-title-label">人數:</label>
                            <input type="text" id="numOfPeople" class="posts-title" name="people" required>
</div>
                        <div>
                            <label class="post-title-label3">預算:</label>
                            <!--input type="text" class="posts-title" name="money" required-->
                            <select id="budget" name="money">
                                <option value="10000以内">1萬以内</option>
                                <option value="10001-15000">10001-15000</option>
                                <option value="15001-20000">15001-20000</option>
                                <option value="20001-25000">20001-25000</option>
                                <option value="25001-30000">25001-30000</option>
                                <option value="30001-35000">30001-35000</option>
                                <option value="35001-40000">35001-40000</option>
                                <option value="40001-45000">40001-45000</option>
                                <option value="45001-50000">45001-50000</option>
                                <option value="40001-45000">40001-45000</option>
                                <option value="45001-50000">45001-50000</option>
                                <option value="50001-55000">50001-55000</option>
                                <option value="55001-60000">55001-60000</option>
                                <option value="60001-65000">60001-65000</option>
                                <option value="65001-70000">65001-70000</option>
                                <option value="70001-75000">70001-75000</option>
                                <option value="75001-80000">75001-80000</option>
                                <option value="80001-85000">80001-85000</option>
                                <option value="85001-90000">85001-90000</option>
                                <option value="90001-95000">90001-95000</option>
                                <option value="95001-100000">95001-100000</option>
                                <option value="100001以上">10萬以上</option>
                            </select>
</div>
</div>
</div>
</div>

@endsection
