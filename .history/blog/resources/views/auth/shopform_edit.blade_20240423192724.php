@extends('layouts.layoutback')

@section('title', '')

@section('Form')
<form id="postForm" action="{{ route('shop_post_edit',['shopId' => $shopedits->id]) }}" method="POST">
    @csrf
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="mb-3">
                    <label class="post-title-label fw-bolder fs-2">店家發文編輯</label>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">店名:</label>
                    <!--input type="text" class="posts-title" name="destination" required-->
                    <input class="form-control" id="shop_name" name="shop_name" type="text" value="{{ $shopedits->shop_name }}" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">所在縣市:</label>
                    <input class="form-control" name="selectwhere" type="text" value="{{ $shopedits->selectwhere }}" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">營業登記號:</label>
                    <input class="form-control" name="business_registration_number" type="text" value="{{ $shopedits->business_registration_number }}" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">地址:</label>
                    <input class="form-control" name="location" type="text" value="{{ $shopedits->location }}" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">技能:</label>
                    <!--input type="text" class="posts-title" name="money" required-->
                    <select id="driver_license_requirements" name="driver_license_requirements" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="不需要">不需要</option>
                        <option value="car">開車</option>
                        <option value="motorcycle">騎車</option>
                        <option value="both">都需要</option>
                    </select>
                </div>
                <div class="mb-3 text-start ">
                    <label class="post-title-label fw-bolder">招募期間:</label>
                    <input type="text" id="timePicker" name="recruitment_period" class="form-control datepicker" placeholder="{{ $shopedits->recruitment_period }}">
                    <input type="hidden" id="diffDay" value="{{ $shopedits->diffDay }}" name="diffDay">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">性別:</label>
                    <select id="sex" name="sex" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="不拘" @if($shopedits->sex == '不拘') selected @endif>不拘</option>
                        <option value="male" @if($shopedits->sex == 'male') selected @endif>男</option>
                        <option value="female" @if($shopedits->sex == 'female') selected @endif>女</option>
                    </select>
                </div>
                @php
                    $selectedLanguages = explode(',', $shopedits->language);
                @endphp

                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">語言能力:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="中文" id="chineseCheckbox" name="languages[]" {{ in_array('中文', $selectedLanguages) ? 'checked' : '' }}>
                        <label class="form-check-label" for="chineseCheckbox">中文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="日文" id="japaneseCheckbox" name="languages[]" {{ in_array('日文', $selectedLanguages) ? 'checked' : '' }}>
                        <label class="form-check-label" for="japaneseCheckbox">日文</label>
                    </div>
                    <!-- 其他复选框省略 -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="韓文" id="koreanCheckbox" name="languages[]" {{ in_array('韓文', $selectedLanguages) ? 'checked' : '' }}>
                        <label class="form-check-label" for="koreanCheckbox">韓文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="英文" id="englishCheckbox" name="languages[]" {{ in_array('英文', $selectedLanguages) ? 'checked' : '' }}>
                        <label class="form-check-label" for="englishCheckbox">英文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="台語" id="taiwaneseCheckbox" name="languages[]" {{ in_array('台語', $selectedLanguages) ? 'checked' : '' }}>
                        <label class="form-check-label" for="taiwaneseCheckbox">台語</label>
                    </div>
                </div>
                
                
                
                
                
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">工作經驗:</label>
                    <select id="conditions_exp" name="conditions_exp" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="不需要" @if($shopedits->conditions_exp == '不需要') selected @endif>不需要</option>
                        <option value="需要" @if($shopedits->conditions_exp == '需要') selected @endif>需要</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">工作時間(每天):</label>
                    <select id="work_hours" name="work_hours" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="1~2" @if($shopedits->work_hours == '1~2') selected @endif>1~2小時</option>
                        <option value="2~3" @if($shopedits->work_hours == '2~3') selected @endif>2~3小時</option>
                        <option value="3~4" @if($shopedits->work_hours == '3~4') selected @endif>3~4小時</option>
                        <option value="4~5" @if($shopedits->work_hours == '4~5') selected @endif>4~5小時</option>
                        <option value="5~6" @if($shopedits->work_hours == '5~6') selected @endif>5~6小時</option>
                        <option value="6~7" @if($shopedits->work_hours == '6~7') selected @endif>6~7小時</option>
                        <option value="7~8" @if($shopedits->work_hours == '7~8') selected @endif>7~8小時</option>
                        <option value="8~9" @if($shopedits->work_hours == '8~9') selected @endif>8~9小時</option>
                    </select>
                </div>
                @php
                    $job_description = explode(',', $shopedits->job_description);
                @endphp
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">工作內容:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人安排行程" id="arrangeItineraryCheckbox" name="job_description[]" {{ in_array('協助客人安排行程', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="arrangeItineraryCheckbox">協助客人安排行程</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供額外客房服務，如更換床單、補充日用品" id="roomServiceCheckbox" name="job_description[]" {{ in_array('提供額外客房服務，如更換床單、補充日用品', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="roomServiceCheckbox">提供額外客房服務，如更換床單、補充日用品</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供娛樂設施指導" id="entertainmentFacilitiesGuidanceCheckbox" name="job_description[]" {{ in_array('提供娛樂設施指導', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="entertainmentFacilitiesGuidanceCheckbox">提供娛樂設施指導</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人解決問題和投訴" id="problemResolutionCheckbox" name="job_description[]" {{ in_array('協助客人解決問題和投訴', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="problemResolutionCheckbox">協助客人解決問題和投訴</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="參與客人交流和社交活動" id="socialActivitiesCheckbox" name="job_description[]" {{ in_array('參與客人交流和社交活動', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="socialActivitiesCheckbox">參與客人交流和社交活動</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供當地文化和景點推薦" id="localRecommendationsCheckbox" name="job_description[]" {{ in_array('提供當地文化和景點推薦', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="localRecommendationsCheckbox">提供當地文化和景點推薦</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人安排交通和行程" id="transportationArrangementCheckbox" name="job_description[]" {{ in_array('協助客人安排交通和行程', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="transportationArrangementCheckbox">協助客人安排交通和行程</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="參與園區或景點的維護工作" id="parkMaintenanceCheckbox" name="job_description[]" {{ in_array('參與園區或景點的維護工作', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="parkMaintenanceCheckbox">參與園區或景點的維護工作</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助組織和執行特別活動或主題派對" id="eventOrganizationCheckbox" name="job_description[]" {{ in_array('協助組織和執行特別活動或主題派對', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="eventOrganizationCheckbox">協助組織和執行特別活動或主題派對</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供額外客房裝飾服務" id="roomDecorationCheckbox" name="job_description[]" {{ in_array('提供額外客房裝飾服務', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="roomDecorationCheckbox">提供額外客房裝飾服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供簡單的烹飪或烤肉服務" id="cookingServiceCheckbox" name="job_description[]" {{ in_array('提供簡單的烹飪或烤肉服務', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="cookingServiceCheckbox">提供簡單的烹飪或烤肉服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人購買或預訂特定項目或服務" id="purchaseAssistanceCheckbox" name="job_description[]" {{ in_array('協助客人購買或預訂特定項目或服務', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="purchaseAssistanceCheckbox">協助客人購買或預訂特定項目或服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供客人個性化服務，根據其需求和喜好調整服務內容" id="personalizedServiceCheckbox" name="job_description[]" {{ in_array('提供客人個性化服務，根據其需求和喜好調整服務內容', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="personalizedServiceCheckbox">提供客人個性化服務，根據其需求和喜好調整服務內容</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供健康和健身指導" id="healthAndFitnessGuidanceCheckbox" name="job_description[]" {{ in_array('提供健康和健身指導', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="healthAndFitnessGuidanceCheckbox">提供健康和健身指導</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人處理緊急情況和醫療問題" id="emergencyAndMedicalAssistanceCheckbox" name="job_description[]" {{ in_array('協助客人處理緊急情況和醫療問題', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="emergencyAndMedicalAssistanceCheckbox">協助客人處理緊急情況和醫療問題</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="其他" id="authorCheckbox" name="job_description[]" {{ in_array('其他', $job_description) ? 'checked' : '' }}>
                        <label class="form-check-label" for="authorCheckbox">其他</label>
                    </div>
                </div>
                @php
                    $benefits = explode(',', $shopedits->benefits);
                @endphp
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">店家提供:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="住宿" id="accommodation" name="benefits[]" {{ is_array($benefits) && in_array('住宿', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="accommodation">住宿</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="伙食" id="meal" name="benefits[]" {{ is_array($benefits) && in_array('伙食', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="meal">伙食</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="交通" id="transportation" name="benefits[]" {{ is_array($benefits) && in_array('交通', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="transportation">交通</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="健康保險" id="health_insurance" name="benefits[]" {{ is_array($benefits) && in_array('健康保險', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="health_insurance">健康保險</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工折扣" id="employee_discount" name="benefits[]" {{ is_array($benefits) && in_array('員工折扣', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="employee_discount">員工折扣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工活動" id="employee_activities" name="benefits[]" {{ is_array($benefits) && in_array('員工活動', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="employee_activities">員工活動</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="培訓和發展" id="training_development" name="benefits[]" {{ is_array($benefits) && in_array('培訓和發展', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="training_development">培訓和發展</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="彈性工作安排" id="flexible_work_schedule" name="benefits[]" {{ is_array($benefits) && in_array('彈性工作安排', $benefits) ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexible_work_schedule">彈性工作安排</label>
                    </div>
                </div>
                
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder text-start">詳細內容:</label>
                </div>
                <div class="LeaveMessageInput ">
                    <textarea name="editor" id="editor" placeholder="">{{ $shopedits->shop_information }}</textarea> <!-- CKEditor 编辑器 -->
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

