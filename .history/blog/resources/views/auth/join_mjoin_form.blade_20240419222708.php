@extends('layouts.layoutback')

@section('title', '加入揪團')

@section('Form')
<div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">加入揪團</label>
                </div>
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">揪團名稱:</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="small mb-1" for="inputEmailAddress">性別</label>
                    <select id="budget" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="未填寫">未填寫</option>
                        <option value="male">男</option>
                        <option value="female">女</option>
                    </select>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">生日:</label>
                    <input type="text" id="timePicker" name="recruitment_period" class="form-control datepicker" placeholder="請選擇時間">
                    <input type="hidden" id="diffDay" name="diffDay">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">食物過敏:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="甲殼類" id="radio" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">無</label><br>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="甲殼類" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">甲殼類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="芒果" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">芒果</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="芝麻" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">芝麻</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="堅果類" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">堅果類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="花生" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">花生</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="穀物" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">穀物</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="牛奶/羊奶" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">牛奶/羊奶</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="大豆" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">大豆</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="蛋類" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">蛋類</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="魚類" id="chineseCheckbox" name="foodallergy[]">
                        <label class="form-check-label" for="chineseCheckbox">魚類</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">加入理由:</label>
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