<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

@extends('layouts.layoutback')

@section('title', '')

@section('Form')

<form id="postForm" action="{{ route('arkwork_post_posts') }}" method="POST">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">創作發文</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">上傳創作縮圖:</label>
                    <div id="imageContainer" class="mb-2" style="border: 1px solid #000; width: 150px; height: 150px;"></div>
                    <div class="ui small basic icon buttons">
                    <input class="ui button upload icon" type="file" name="image" accept="image/*" onchange="showImage(this);"><i class="upload icon"></i>
                    </div>
                    
                <div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">標題:</label>
                    <input class="form-control" type="text" name="title" placeholder="" aria-label="title">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">分類:</label>
                    <!--input type="text" class="posts-title" name="destination" required-->
                    <select id="class" name="class" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="揪團">揪團</option>
                        <option value="打工">打工</option>
                        <option value="心情">心情</option>
                        <option value="創作">創作</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">內容:</label>
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
                function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.style.maxWidth = '150px';
                    image.style.maxHeight = '150px';
                    document.getElementById('imageContainer').innerHTML = '';
                    document.getElementById('imageContainer').appendChild(image);
                };

                reader.readAsDataURL(input.files[0]);
            }
        } 
                  
</script>
@endsection