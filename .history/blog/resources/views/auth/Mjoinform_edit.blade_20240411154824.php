@extends('layouts.layoutback')

@section('title', '')

@section('Form')
<form id="postForm" action="{{ route('mjoin_post_posts') }}" method="POST">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">揪團發文</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">標題:</label>
                    <input type="text" class="posts-title form-control" name="title" value="{{ $mjoinedits->title }}" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">目的:</label>
                    <!--input type="text" class="posts-title" name="destination" required-->
                    <select id="selectwhere" name="destination" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="臺北市" @if($mjoinedits->destination == '臺北市') selected @endif>臺北市</option>
                        <option value="新北市" @if($mjoinedits->destination == '新北市') selected @endif>新北市</option>
                        <option value="桃園市" @if($mjoinedits->destination == '桃園市') selected @endif>桃園市</option>
                        <option value="臺中市" @if($mjoinedits->destination == '臺中市') selected @endif>臺中市</option>
                        <option value="臺南市" @if($mjoinedits->destination == '臺南市') selected @endif>臺南市</option>
                        <option value="高雄市" @if($mjoinedits->destination == '高雄市') selected @endif>高雄市</option>
                        <option value="新竹縣" @if($mjoinedits->destination == '新竹縣') selected @endif>新竹縣</option>
                        <option value="苗栗縣" @if($mjoinedits->destination == '苗栗縣') selected @endif>苗栗縣</option>
                        <option value="彰化縣" @if($mjoinedits->destination == '彰化縣') selected @endif>彰化縣</option>
                        <option value="南投縣" @if($mjoinedits->destination == '南投縣') selected @endif>南投縣</option>
                        <option value="雲林縣" @if($mjoinedits->destination == '雲林縣') selected @endif>雲林縣</option>
                        <option value="嘉義縣" @if($mjoinedits->destination == '嘉義縣') selected @endif>嘉義縣</option>
                        <option value="屏東縣" @if($mjoinedits->destination == '屏東縣') selected @endif>屏東縣</option>
                        <option value="宜蘭縣" @if($mjoinedits->destination == '宜蘭縣') selected @endif>宜蘭縣</option>
                        <option value="花蓮縣" @if($mjoinedits->destination == '花蓮縣') selected @endif>花蓮縣</option>
                        <option value="臺東縣" @if($mjoinedits->destination == '臺東縣') selected @endif>臺東縣</option>
                        <option value="澎湖縣" @if($mjoinedits->destination == '澎湖縣') selected @endif>澎湖縣</option>
                        <option value="金門縣" @if($mjoinedits->destination == '金門縣') selected @endif>金門縣</option>
                        <option value="連江縣" @if($mjoinedits->destination == '連江縣') selected @endif>連江縣</option>
                        <option value="基隆市" @if($mjoinedits->destination == '基隆市') selected @endif>基隆市</option>
                        <option value="新竹市" @if($mjoinedits->destination == '新竹市') selected @endif>新竹市</option>
                        <option value="嘉義市" @if($mjoinedits->destination == '嘉義市') selected @endif>嘉義市</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder" for="timePicker">時間:</label>
                    <input type="text" id="timePicker" name="time" class="form-control datepicker" placeholder="{{ $mjoinedits->time }}" value="{{ $mjoinedits->time }}" required>
                    <input type="hidden" id="diffDay" name="diffDay" value="{{ $mjoinedits->diffDay }}" required>
                </div>

                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">人數:</label>
                    <!--input type="text" id="numOfPeople" class="posts-title" name="people" required-->
                    <select id="budget" name="people" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" @if($mjoinedits->people == '') selected @endif>不限</option>
                        <option value="2~4" @if($mjoinedits->people == '2~4') selected @endif>兩人~四人</option>
                        <option value="5~7" @if($mjoinedits->people == '5~7') selected @endif>五人~七人</option>
                        <option value="8~10" @if($mjoinedits->people == '8~10') selected @endif>八人~十人</option>
                        <option value="11" @if($mjoinedits->people == '11') selected @endif>十人以上</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">預算:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="money" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="10000" @if($mjoinedits->money == '10000') selected @endif>1萬以内</option>
                        <option value="10001-15000" @if($mjoinedits->money == '10001-15000') selected @endif>10001-15000</option>
                        <option value="15001-20000" @if($mjoinedits->money == '15001-20000') selected @endif>15001-20000</option>
                        <option value="20001-25000" @if($mjoinedits->money == '20001-25000') selected @endif>20001-25000</option>
                        <option value="25001-30000" @if($mjoinedits->money == '25001-30000') selected @endif>25001-30000</option>
                        <option value="30001-35000" @if($mjoinedits->money == '30001-35000') selected @endif>30001-35000</option>
                        <option value="35001-40000" @if($mjoinedits->money == '35001-40000') selected @endif>35001-40000</option>
                        <option value="40001-45000" @if($mjoinedits->money == '40001-45000') selected @endif>40001-45000</option>
                        <option value="45001-50000" @if($mjoinedits->money == '45001-50000') selected @endif>45001-50000</option>
                        <option value="50001-55000" @if($mjoinedits->money == '50001-55000') selected @endif>50001-55000</option>
                        <option value="55001-60000" @if($mjoinedits->money == '55001-60000') selected @endif>55001-60000</option>
                        <option value="60001-65000" @if($mjoinedits->money == '60001-65000') selected @endif>60001-65000</option>
                        <option value="65001-70000" @if($mjoinedits->money == '65001-70000') selected @endif>65001-70000</option>
                        <option value="70001-75000" @if($mjoinedits->money == '70001-75000') selected @endif>70001-75000</option>
                        <option value="75001-80000" @if($mjoinedits->money == '75001-80000') selected @endif>75001-80000</option>
                        <option value="80001-85000" @if($mjoinedits->money == '80001-85000') selected @endif>80001-85000</option>
                        <option value="85001-90000" @if($mjoinedits->money == '85001-90000') selected @endif>85001-90000</option>
                        <option value="90001-95000" @if($mjoinedits->money == '90001-95000') selected @endif>90001-95000</option>
                        <option value="95001-100000" @if($mjoinedits->money == '95001-100000') selected @endif>95001-100000</option>
                        <option value="100001" @if($mjoinedits->money == '100001') selected @endif>10萬以上</option>

                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">性別:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" @if($mjoinedits->sex == '') selected @endif>不拘</option>
                        <option value="male" @if($mjoinedits->sex == 'male') selected @endif>男</option>
                        <option value="female" @if($mjoinedits->sex == 'female') selected @endif>女</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">技能:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="skill" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" @if($mjoinedits->skill == '') selected @endif>不需要</option>
                        <option value="car" @if($mjoinedits->skill == 'car') selected @endif>開車</option>
                        <option value="motorcycle" @if($mjoinedits->skill == 'motorcycle') selected @endif>騎車</option>
                        <option value="both" @if($mjoinedits->skill == 'both') selected @endif>都需要</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">年齡:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="age" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" @if($mjoinedits->age == '') selected @endif>不限制</option>
                        <option value="20" @if($mjoinedits->age == '20') selected @endif>20~30歲</option>
                        <option value="31" @if($mjoinedits->age == '31') selected @endif>31~40歲</option>
                        <option value="41" @if($mjoinedits->age == '41') selected @endif>41~50歲</option>
                        <option value="51" @if($mjoinedits->age == '51') selected @endif>50歲以上</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">詳細內容:</label>
                </div>
                <div class="LeaveMessageInput ">
                    <textarea name="editor" id="editor" placeholder="">{!! $mjoinedits->description !!}</textarea> <!-- CKEditor 编辑器 -->
                </div>
                <div class="mb-3 pt-3">
                    <input type="submit" id="submitBtn" class="btn btn-primary" value="發文" />
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    flatpickr(".datepicker", {
        mode: "range",
        dateFormat: "Y-m-d", // 設置日期格式為年/月/日
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                const rangeStart = selectedDates[0];
                const rangeEnd = selectedDates[1];
                
                const startFormatted = rangeStart.toLocaleDateString("en-US", { year: 'numeric', month: '2-digit', day: '2-digit' });
                const endFormatted = rangeEnd.toLocaleDateString("en-US", { year: 'numeric', month: '2-digit', day: '2-digit' });

                instance.input.value = startFormatted + " - " + endFormatted;
                document.getElementById('timePicker').value = startFormatted + " - " + endFormatted;

                const oneDay = 24 * 60 * 60 * 1000;

                const differenceMs = Math.abs(rangeStart.getTime() - rangeEnd.getTime());

                const diffDay = Math.round(differenceMs / oneDay);
                document.getElementById('diffDay').value = diffDay;
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
@endsection

