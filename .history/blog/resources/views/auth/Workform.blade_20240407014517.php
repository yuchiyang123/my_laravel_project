@extends('layouts.layoutback')

@section('title', '')

@section('Form')
<form id="postForm" action="{{ route('work_post_posts') }}" method="POST">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">店家發文</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">標題:</label>
                    <input type="text" class="posts-title form-control" name="title" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">店名:</label>
                    <!--input type="text" class="posts-title" name="destination" required-->
                    <select id="shop_name" name="shop_name" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="臺北市">臺北市</option>
                        <option value="新北市">新北市</option>
                    </select>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">所在縣市:</label>
                    <label class="post-title-label fw-bolder">會自動選</label>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">營業登記號:</label>
                    <label class="post-title-label fw-bolder">會自動選</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">地址:</label>
                    <label class="post-title-label fw-bolder">會自動選</label>
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
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">招募期間:</label>
                    <input type="text" id="timePicker" name="time" class="form-control datepicker" placeholder="請選擇時間">
                    <input type="hidden" id="diffDay" name="diffDay">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">性別:</label>
                    <select id="sex" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不拘</option>
                        <option value="male">男</option>
                        <option value="female">女</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">語言能力:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Chinese" id="chineseCheckbox" name="languages[]">
                        <label class="form-check-label" for="chineseCheckbox">中文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Japanese" id="japaneseCheckbox" name="languages[]">
                        <label class="form-check-label" for="japaneseCheckbox">日本語</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Korean" id="koreanCheckbox" name="languages[]">
                        <label class="form-check-label" for="koreanCheckbox">韓文</label>
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

