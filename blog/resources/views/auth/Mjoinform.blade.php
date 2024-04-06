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
                    <input type="text" class="posts-title form-control" name="title" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">目的:</label>
                    <!--input type="text" class="posts-title" name="destination" required-->
                    <select id="selectwhere" name="destination" required class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">時間:</label>
                    <input type="text" id="timePicker" name="time" class="form-control datepicker" placeholder="請選擇時間">
                    <input type="hidden" id="diffDay" name="diffDay">
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">人數:</label>
                    <!--input type="text" id="numOfPeople" class="posts-title" name="people" required-->
                    <select id="budget" name="people" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不限</option>
                        <option value="2">兩人</option>
                        <option value="3">三人</option>
                        <option value="4">四人</option>
                        <option value="5">五人</option>
                        <option value="6">六人</option>
                        <option value="7">七人</option>
                        <option value="8">八人</option>
                        <option value="9">九人</option>
                        <option value="10">十人</option>
                        <option value="11">十人以上</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">預算:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="money" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">性別:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不拘</option>
                        <option value="male">男</option>
                        <option value="female">女</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">技能:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="skill" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不需要</option>
                        <option value="car">開車</option>
                        <option value="motorcycle">騎車</option>
                        <option value="both">都需要</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">年齡:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="budget" name="age" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不限制</option>
                        <option value="20">20~30歲</option>
                        <option value="31">31~40歲</option>
                        <option value="41">41~50歲</option>
                        <option value="51">50歲以上</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">詳細內容:</label>
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

