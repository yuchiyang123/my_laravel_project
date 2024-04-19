@extends('layouts.layoutback')

@section('title', '加入揪團')

@section('Form')
<form method="POST" action="">
    @csrf
<div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">加入揪團</label>
                </div>
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">揪團名稱:{{ $User_mjoin_infor->title }}</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">性別</label>
                    <select id="budget" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @if($User_infor->sex ==  '未填寫')
                        <option value="未填寫"  @if($User_infor->sex == '未填寫') selected @endif>未填寫</option>
                        <option value="male" @if($User_infor->sex == 'male') selected @endif>男</option>
                        <option value="female" @if($User_infor->sex == 'female') selected @endif>女</option>
                    @else
                        <option value="male" @if($User_infor->sex == 'male') selected @endif>男</option>
                        <option value="female" @if($User_infor->sex == 'female') selected @endif>女</option>
                    @endif
                    </select>

                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">你的生日:</label>
                    @if($User_infor->age ==  '')
                        <input type="text" id="timePicker" name="recruitment_period" class="form-control datepicker" placeholder="請選擇時間">
                    @else
                        <input type="text" id="timePicker" name="recruitment_period" class="form-control datepicker" value="{{ $User_infor->age }}" readonly>
                    @endif
                    <label class="">P.S.會自動計算年紀</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">偏好旅遊方式:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="無過敏" id="radio_none_preferences" name="preferences[]" checked>
                        <label class="form-check-label" for="radio_none">無特別要求</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="hiking" name="preferences[]" value="徒步旅行">
                        <label class="form-check-label" for="hiking">徒步旅行</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="cycling" name="preferences[]" value="騎行">
                        <label class="form-check-label" for="cycling">騎行</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="camping" name="preferences[]" value="露營">
                        <label class="form-check-label" for="camping">露營</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="swimming" name="preferences[]" value="游泳">
                        <label class="form-check-label" for="swimming">游泳</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="picnic" name="preferences[]" value="野餐">
                        <label class="form-check-label" for="picnic">野餐</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="cooking" name="preferences[]" value="烹飪">
                        <label class="form-check-label" for="cooking">烹飪</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="sports" name="preferences[]" value="體育運動">
                        <label class="form-check-label" for="sports">體育運動</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="music" name="preferences[]" value="音樂活動">
                        <label class="form-check-label" for="music">音樂活動</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">食物過敏:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="無過敏" id="radio_none" name="foodallergy[]" checked>
                        <label class="form-check-label" for="radio_none">無過敏</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="甲殼類" id="checkbox_crustacean" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_crustacean">甲殼類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="芒果" id="checkbox_mango" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_mango">芒果</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="芝麻" id="checkbox_sesame" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_sesame">芝麻</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="堅果類" id="checkbox_nuts" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_nuts">堅果類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="花生" id="checkbox_peanut" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_peanut">花生</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="穀物" id="checkbox_grain" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_grain">穀物</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="牛奶/羊奶" id="checkbox_milk" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_milk">牛奶/羊奶</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="大豆" id="checkbox_soy" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_soy">大豆</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="蛋類" id="checkbox_egg" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_egg">蛋類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="魚類" id="checkbox_fish" name="foodallergy[]">
                        <label class="form-check-label" for="checkbox_fish">魚類</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">語言能力:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Chinese" id="chineseCheckbox" name="languages[]" checked>
                        <label class="form-check-label" for="chineseCheckbox">中文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="English" id="englishCheckbox" name="languages[]">
                        <label class="form-check-label" for="englishCheckbox">英文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Taiwanese" id="taiwaneseCheckbox" name="languages[]">
                        <label class="form-check-label" for="taiwaneseCheckbox">台語</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">駕照：</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="沒有" id="radio_none_license" name="license[]" checked>
                        <label class="form-check-label" for="radio_none_license">沒有</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="car_license" name="license[]" value="汽車">
                        <label class="form-check-label" for="car_license">汽車</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="motorcycle_license" name="license[]" value="機車">
                        <label class="form-check-label" for="motorcycle_license">機車</label>
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">聯絡方式：</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contact_method_insite" name="contact_method[]" value="站內" checked>
                        <label class="form-check-label" for="contact_method_insite">站內</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contact_method_phone" name="contact_method[]" value="電話">
                        <label class="form-check-label" for="contact_method_phone">電話</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contact_method_email" name="contact_method[]" value="Email">
                        <label class="form-check-label" for="contact_method_email">Email</label>
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">說說你為什麼想加入這個團隊？</label>
                </div>
                <div class="LeaveMessageInput ">
                    <textarea name="editor" id="editor" placeholder="請輸入內容"></textarea> <!-- CKEditor 编辑器 -->
                </div>
                <div class="mb-3 pt-3">
                    <input type="submit" class="btn btn-primary" value="發文" />
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    //互斥
    // 监听单选按钮和复选框的点击事件
    // 获取单选按钮和复选框
        // 获取单选按钮和复选框
    const radioNone = document.getElementById('radio_none');
    const checkboxes = document.querySelectorAll('.form-check-inline input[name="foodallergy[]"][type="checkbox"]');

    // 监听单选按钮的点击事件
    radioNone.addEventListener('change', function() {
        if(this.checked) {
            // 如果单选按钮被选中，取消所有复选框的选择
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    });

    // 监听复选框的点击事件
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if(this.checked) {
                // 如果复选框被选中，取消单选按钮的选择
                radioNone.checked = false;
            }
        });
    });

    //偏好設定
   // 偏好設定
    const radioNonePreferences = document.getElementById('radio_none_preferences');
    const checkboxesPreferences = document.querySelectorAll('.form-check-inline input[name="preferences[]"][type="checkbox"]');

    // 监听单选按钮的点击事件
    radioNonePreferences.addEventListener('change', function() {
        if (this.checked) {
            // 如果单选按钮被选中，取消所有复选框的选择
            checkboxesPreferences.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    });

    // 监听复选框的点击事件
    checkboxesPreferences.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // 如果复选框被选中，取消单选按钮的选择
                radioNonePreferences.checked = false;
            }
        });
    });

    //駕照
    const radioNoneLicense = document.getElementById('radio_none_license');
    const checkboxesLicense = document.querySelectorAll('.form-check-inline input[name="license[]"][type="checkbox"]'); 

    // 监听单选按钮的点击事件
    radioNoneLicense.addEventListener('change', function() {
        if (this.checked) {
            // 如果单选按钮被选中，取消所有复选框的选择
            checkboxesLicense.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    });

    // 监听复选框的点击事件
    checkboxesLicense.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // 如果复选框被选中，取消单选按钮的选择
                radioNoneLicense.checked = false;
            }
        });
    });



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
@endsection