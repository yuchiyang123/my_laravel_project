@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 引入 Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<!-- 引入 Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- 引入 jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<style>
    .cropper-crop-box, .cropper-view-box {
    border-radius: 50%;
}

.cropper-view-box {
    box-shadow: 0 0 0 1px #39f;
    outline: 0;
}
</style>


</head>
<body>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="/edit_profile" target="__blank">基本資料</a>
        <a class="nav-link" href="#" target="__blank">更改密碼</a>
        <a class="nav-link" href="#" target="__blank">小屋設定</a>
    </nav>
    <hr class="mt-0 mb-4">
    <form action="{{ route('editProfilesubmit') }}" method="get">
    @csrf
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">頭貼</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <!--div id="profile-image-container">
                        <img id="profile-image" class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Picture">
                    </div-->

                    <!-- Profile picture help block-->
                    <!--div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div-->
                    <!-- Profile picture upload button-->
                    <!--input type="file" id="upload-input" accept="image/*" style="display:none;" title="Choose an image to upload">

                    <button id="upload-button" class="btn btn-primary" type="button">Upload new image</button>
                    <button id="crop-button" class="btn btn-success" type="button" style="display:none;">Crop Image</button-->
                    <!-- 上传按钮 -->
                    <input type="file" id="upload-input" accept="image/*" style="display:none;">

                    <!-- 显示原始图片 -->
                    <img id="original-image" class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile Picture">

                    <div class="small font-italic text-muted mb-4">JPG、JPEG、PNG 不得超過 5 MB</div>
                    <!-- 模态框 -->
                    <div class="modal fade" id="crop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">裁剪圖片</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="cropper-container"><img id="original-image-modal" src="" alt=""></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="crop-button">裁剪</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <button id="upload-button" class="btn btn-primary" type="button">上傳圖片</button>
                </div>
            </div>


        </div>

        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">用戶設定</div>
                <div class="card-body">
                    
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">用戶名:{{ $userdataedit->username }}</label>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">電子郵件:{{ $userdataedit->email }}</label>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">電話: {{ $userdataedit->phone }}
                                <span>@if($userdataedit->verify=='yes')已驗證@else未驗證,<a href="/user_verify_phone">點我驗證</a>@endif<span></label>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">
                                身分組:
                                @if($userdataedit->permissions == 3)
                                    使用者
                                @else
                                    @if($userdataedit->permissions == 2)
                                        店家
                                    @endif
                                @endif
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">密碼:</label>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">性別</label>
                                <select id="budget" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option value="male" @if($userdataedit->sex == '未填寫') selected @endif>未填寫</option>
                                    <option value="male" @if($userdataedit->sex == 'male') selected @endif>男</option>
                                    <option value="female" @if($userdataedit->sex == 'female') selected @endif>女</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                @if($user_public->user_sex_public == 0)
                                    <input name="sex_public" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        公開
                                    </label>
                                @else
                                    <input name="sex_public" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        公開
                                    </label>
                                @endif

                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 text-start">
                                    <label name="sex_public" class="small mb-1" for="timePicker">生日:</label>
                                    <input type="time" id="timePicker" name="time" class="form-control datepicker" placeholder="{{ $userdataedit->age }}" required value="{{ $userdataedit->age }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                @if($user_public->user_age_public == 0)
                                    <input name="age_public" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        公開
                                    </label>
                                @else
                                    <input name="age_public" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        公開
                                    </label>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">儲存</button>
                    
                </div>
            </div>
        </div>
    </div>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".datepicker", {
        enableTime: false, // 启用时间选择
        mode: "single", // 将模式设置为单个日期
        dateFormat: "Y-m-d", // 设置日期和时间格式
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 1) { // 检查是否选择了日期
                const selectedDate = selectedDates[0]; // 获取选择的日期
                instance.input.value = dateStr; // 将格式化后的日期和时间设置为输入框的值
            }
        }
    });



        /*
        class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return new Promise((resolve, reject) => {
                        const reader = new window.FileReader();

                        reader.addEventListener('load', () => {
                            // 这里应该是上传文件到服务器的逻辑
                            // 在这个示例中，我们简单地将DataURL作为返回值
                            resolve({
                                default: reader.result
                            });
                        });

                        reader.addEventListener('error', err => {
                            reject(err);
                        });

                        reader.addEventListener('abort', () => {
                            reject();
                        });

                        this.loader.file.then(file => {
                            reader.readAsDataURL(file);
                        });
                    });
                }

                abort() {
                    // 这个方法用于中止文件上传过程
                    // 在这个示例中，我们没有实现中止逻辑
                }
            }

            function MyAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader);
                };
            }
*/
            /*const editorElement = document.querySelector('#editor');
            ClassicEditor
                .create(editorElement, {
                    extraPlugins: [MyAdapterPlugin],
                    // 其他配置项...
                })
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error(error);
                });  */
                // 点击上传图片按钮后弹出模态框
                // 当点击上传按钮时触发文件输入框的点击事件
                $('#upload-button').click(function(){
                    $('#upload-input').click();
                });
            $(document).ready(function() {
            // 当用户选择图片后显示模态框
            $('#upload-input').change(function(e) {
                if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#original-image-modal').attr('src', event.target.result);
                    $('#crop-modal').modal('show');
                };
                reader.readAsDataURL(this.files[0]);
                }
            });

            // 初始化 Cropper
            var cropper;
            $('#crop-modal').on('shown.bs.modal', function () {
                var image = document.getElementById('original-image-modal');
                cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                guides: true,
                background: false,
                modal: true,
                scalable: true
                });
            });

            // 当点击裁剪按钮后
            $('#crop-button').click(function() {
                // 获取裁剪后的图片数据
                var canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200
                });
                var croppedUrl = canvas.toDataURL('image/png');

                // 显示裁剪后的图片，并隐藏上传按钮
                $('#original-image').attr('src', croppedUrl);
                $('#upload-input').hide();

                // 隐藏模态框
                $('#crop-modal').modal('hide');

                // 销毁 Cropper 实例
                cropper.destroy();

                $('#upload-input').val('');
            });
            reader.readAsDataURL(this.files[0]);
            });





</script>
</body>
</html>