@include('header')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="/edit_profile" target="__blank">基本資料</a>
        <a class="nav-link" href="#" target="__blank">更改密碼</a>
        <a class="nav-link" href="#" target="__blank">小屋設定</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">用戶設定</div>
                <div class="card-body">
                    <form action="/edit_profile/submit" method="get">
                        @csrf
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
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label name="sex_public" class="form-check-label" for="flexCheckChecked">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".datepicker", {
        mode: "single", // 將模式設置為單個日期
        dateFormat: "Y-m-d", // 設置日期格式為年/月/日
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 1) { // 檢查是否選擇了日期
                const selectedDate = selectedDates[0]; // 取得選擇的日期
                    
                const formattedDate = selectedDate.toLocaleDateString("en-US", { year: 'numeric', month: '2-digit', day: '2-digit' });

                instance.input.value = formattedDate;
                document.getElementById('timePicker').value = formattedDate;
            }
        }
    });

        document.getElementById("submitBtn").addEventListener("click", function(event) {
            var timePickerValue = document.getElementById("timePicker").value;
            var diffDayValue = document.getElementById("diffDay").value;
            
            if (!timePickerValue || !diffDayValue) {
                alert("請選擇時間和填寫 diffDay 欄位");
                event.preventDefault(); // 阻止表单提交
            }
        });
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

            const editorElement = document.querySelector('#editor');
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
                });  
                  
</script>

