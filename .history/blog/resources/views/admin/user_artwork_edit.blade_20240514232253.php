@extends('admin.layout.layout')

@section('main_content')

<form id="" action="/user_cms_artwork_edit_submit_{{ $userarkworkedit->id }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">創作編輯</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">上傳創作縮圖:</label>
                    <?php $imageDataUri = 'data:' . $userarkworkedit->image_type  . ';base64,' . base64_encode( $userarkworkedit->image_data ); ?>
                    <div id="imageContainer" class="mb-2" style="border: 1px solid #000; width: 150px; height: 150px;">
                        @if ($userarkworkedit->image_data)
                            <img src="{{ $imageDataUri }}" style="width: 100%; height: 100%;" alt="Current Image">
                        @endif
                    </div>
                    <div class="ui small basic icon buttons">
                        <input class="ui button upload icon" type="file" name="image" accept="image/*" onchange="showImage(this);" value="{{ $imageDataUri }}">
                    </div>
                <div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">標題:</label>
                    <input class="form-control" type="text" name="title" placeholder="" aria-label="title" value="{{ $userarkworkedit->title }}">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">分類:</label>
                    <select id="class" name="class" required class="form-select form-select" aria-label=".form-select example">
                        <option value="揪團" @if($userarkworkedit->class == '揪團') selected @endif>揪團</option>
                        <option value="打工" @if($userarkworkedit->class == '打工') selected @endif>打工</option>
                        <option value="心情" @if($userarkworkedit->class == '心情') selected @endif>心情</option>
                        <option value="創作" @if($userarkworkedit->class == '創作') selected @endif>創作</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">內容:</label>
                </div>
                <div class="LeaveMessageInput" style="color: #000">
                    <textarea name="editor" id="editor" placeholder="">{!! $userarkworkedit->main !!}</textarea>
                </div>
</form>
                <div class="mb-3 pt-3">
                    <input type="submit" class="btn btn-primary" value="編輯" />
                </div>
            </div>
        </div>
    </div>

<script>
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