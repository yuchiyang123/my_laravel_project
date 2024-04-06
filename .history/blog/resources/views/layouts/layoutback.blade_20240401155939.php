<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/frontpagestyles.css') }}">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @include('header')

    <div id="box" class="box">

        <div class="grid-container">
            <div></div>
                <div class="four"></div>
                <div class="first">
                </div>
                <div class="five"></div>
                <div class="grid-item">
                    <div class="end">3</div>
                </div>
                    
                <div class="mid">

                    @yield("Form")

                </div>

        </div>
    </div>
</body>
<script>
    const startInput = document.createElement('input');
    startInput.setAttribute('type', 'hidden');
    startInput.setAttribute('name', 'start_date');
    startInput.setAttribute('value', startFormatted);

    const endInput = document.createElement('input');
    endInput.setAttribute('type', 'hidden');
    endInput.setAttribute('name', 'end_date');
    endInput.setAttribute('value', endFormatted);

    document.getElementById('postForm').appendChild(startInput);
    document.getElementById('postForm').appendChild(endInput);
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