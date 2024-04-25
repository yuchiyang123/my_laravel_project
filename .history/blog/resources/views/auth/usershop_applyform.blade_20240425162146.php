
@extends('layouts.layoutback')

@section('title', '')

@section('Form')
<form id="postForm" action="/shop_apply_form/submit" method="GET" enctype="multipart/form-data">
    
    @csrf
    
    <script>
        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.style.maxWidth = '750px';
                    image.style.maxHeight = '350px';
                    document.getElementById('imageContainer').innerHTML = '';
                    document.getElementById('imageContainer').appendChild(image);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function showImage1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.style.maxWidth = '750px';
                    image.style.maxHeight = '350px';
                    document.getElementById('imageContainer1').innerHTML = '';
                    document.getElementById('imageContainer1').appendChild(image);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">店家申請表</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">店家名稱:</label>
                    <input type="text" class="posts-title form-control" name="company_name" required>
                </div>
                
                
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">聯繫方式:</label>
                    <input type="text" class="posts-title form-control" name="phone_number" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">公司行號:</label>
                    <input type="text" class="posts-title form-control" name="uniform_numbers" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">所在縣市:</label>
                    <select id="selectwhere" name="county" required class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">公司地點:</label>
                    <input type="text" class="posts-title form-control" name="company_location" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">申請人:</label>
                    <input type="text" class="posts-title form-control" name="applicant" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">營業登記:</label>
                    <div id="imageContainer" class="mb-2" style="border: 1px solid #000; width: 760px; height: 360px;"></div>
                    <div class="ui small basic icon buttons">
                        <input class="ui button upload icon" type="file" name="image" accept="image/*" onchange="showImage(this);">
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">身分證明:</label>
                    <div id="imageContainer1" class="mb-2" style="border: 1px solid #000; width: 760px; height: 360px;"></div>
                    <div class="ui small basic icon buttons">
                        <input class="ui button upload icon" type="file" name="image1" accept="image/*" onchange="showImage1(this);">
                    </div>
                </div>
                <div class="mb-3 pt-3">
                    <input type="submit" id="submitBtn" class="btn btn-primary" value="發文" />
                </div>
            </div>
        </div>
    </div>
</form>

   <script>
       window.onload = function() {
            var submitButton = document.getElementById('submitBtn');
            function validateForm(event) {
                var fileInput1 = document.getElementById('fileInput1');
                var fileInput2 = document.getElementById('fileInput2');
                if (fileInput1.files.length === 0 || fileInput2.files.length === 0) {
                    alert('请先选择两个文件！');
                    event.preventDefault(); 
                }
            }
            submitButton.addEventListener('click', validateForm);
        }

    </script>

@endsection

