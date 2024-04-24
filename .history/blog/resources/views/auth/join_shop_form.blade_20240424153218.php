@extends('layouts.layoutback')

@section('title', '申請打工')

@section('Form')
<form method="POST" action="/join_shop/submit/{{ $User_shop_info->id }}">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">申請打工</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者姓名：</label>
                    <input type="text" name="name" class="form-control" placeholder="請輸入姓名" style="display: none;s">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者電子郵件地址：</label>
                    <input type="email" name="email" class="form-control" placeholder="請輸入電子郵件" style="display: none;" value="{{ Auth::user()->email }}">
                    
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者聯繫電話：</label>
                    <input type="text" name="contact_number" class="form-control" placeholder="請輸入聯繫電話" style="display: none;" value="{{ $User_infor->phone }}">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">期望的待遇：</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="住宿" id="accommodation" name="expected_salary[]">
                        <label class="form-check-label" for="accommodation">住宿</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="伙食" id="meal" name="expected_salary[]">
                        <label class="form-check-label" for="meal">伙食</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="交通" id="transportation" name="expected_salary[]">
                        <label class="form-check-label" for="transportation">交通</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="健康保險" id="health_insurance" name="expected_salary[]">
                        <label class="form-check-label" for="health_insurance">健康保險</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工折扣" id="employee_discount" name="expected_salary[]">
                        <label class="form-check-label" for="employee_discount">員工折扣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工活動" id="employee_activities" name="expected_salary[]">
                        <label class="form-check-label" for="employee_activities">員工活動</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="培訓和發展" id="training_development" name="expected_salary[]">
                        <label class="form-check-label" for="training_development">培訓和發展</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="彈性工作安排" id="flexible_work_schedule" name="expected_salary[]">
                        <label class="form-check-label" for="flexible_work_schedule">彈性工作安排</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者的個性描述：</label><br>
                    <input type="checkbox" name="personality[]" value="外向"> 外向<br>
                    <input type="checkbox" name="personality[]" value="積極"> 積極<br>
                    <input type="checkbox" name="personality[]" value="勤奮"> 勤奮<br>
                    <input type="checkbox" name="personality[]" value="樂觀"> 樂觀<br>
                    <input type="checkbox" name="personality[]" value="熱情"> 熱情<br>
                    <input type="checkbox" name="personality[]" value="自信"> 自信<br>
                    <input type="checkbox" name="personality[]" value="創造力"> 創造力<br>
                    <input type="checkbox" name="personality[]" value="合作性"> 合作性<br>
                    <input type="checkbox" name="personality[]" value="積極向上"> 積極向上<br>
                    <input type="checkbox" name="personality[]" value="熱心"> 熱心<br>
                    <input type="checkbox" name="personality[]" value="積極主動"> 積極主動<br>
                    <input type="checkbox" name="personality[]" value="有決心"> 有決心<br>
                    <input type="checkbox" name="personality[]" value="積極進取"> 積極進取<br>
                    <input type="checkbox" name="personality[]" value="充滿活力"> 充滿活力<br>
                    <input type="checkbox" name="personality[]" value="勇於挑戰"> 勇於挑戰<br>
                    <input type="checkbox" name="personality[]" value="有毅力"> 有毅力<br>
                </div>
                
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">是否持有駕照：</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="有" id="driving_license_yes" name="driving_license">
                        <label class="form-check-label" for="driving_license_yes">有</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="無" id="driving_license_no" name="driving_license">
                        <label class="form-check-label" for="driving_license_no">無</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請工作的動機：</label>
                    <textarea name="motivation" id="editor" class="form-control" placeholder="請輸入申請工作的動機"></textarea>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">可工作時間：</label>
                    <select id="availability" name="availability" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="1~2" selected>1~2小時</option>
                        <option value="2~3">2~3小時</option>
                        <option value="3~4">3~4小時</option>
                        <option value="4~5">4~5小時</option>
                        <option value="5~6">5~6小時</option>
                        <option value="6~7">6~7小時</option>
                        <option value="7~8">7~8小時</option>
                        <option value="8~9">8~9小時</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">工作經驗：</label>
                    <select id="work_experience" name="work_experience" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="不需要" selected>不需要</option>
                        <option value="需要">需要</option>
                    </select>
                </div>
                <div class="mb-3 pt-3">
                    <input type="submit" class="btn btn-primary" value="送出申請" />
                </div>
            </div>
        </div>
    </div>
</form>
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
</script>
@endsection
