@extends('layouts.layoutback')

@section('title', '')

@section('Form')
<form id="postForm" action="{{ route('shop_post_edit',['mjoinId' => $mjoinedits->id]) }}" method="POST">
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
                    shopedits shop_name
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
                    <input type="text" id="timePicker" name="recruitment_period" class="form-control datepicker" placeholder="請選擇時間">
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
                    <label class="post-title-label3 fw-bolder">語言能力:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Chinese" id="chineseCheckbox" name="languages[]">
                        <label class="form-check-label" for="chineseCheckbox">中文</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Japanese" id="japaneseCheckbox" name="languages[]">
                        <label class="form-check-label" for="japaneseCheckbox">日文</label>
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
                    <label class="post-title-label3 fw-bolder">工作經驗:</label>
                    <select id="conditions_exp" name="conditions_exp" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="">不需要</option>
                        <option value="need">需要</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label3 fw-bolder">工作時間(每天):</label>
                    <select id="work_hours" name="work_hours" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="1~2">1~2小時</option>
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
                    <label class="post-title-label3 fw-bolder">工作內容:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人安排行程" id="arrangeItineraryCheckbox" name="job_description[]">
                        <label class="form-check-label" for="arrangeItineraryCheckbox">協助客人安排行程</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供額外客房服務，如更換床單、補充日用品" id="roomServiceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="roomServiceCheckbox">提供額外客房服務，如更換床單、補充日用品</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供娛樂設施指導" id="entertainmentFacilitiesGuidanceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="entertainmentFacilitiesGuidanceCheckbox">提供娛樂設施指導</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人解決問題和投訴" id="problemResolutionCheckbox" name="job_description[]">
                        <label class="form-check-label" for="problemResolutionCheckbox">協助客人解決問題和投訴</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="參與客人交流和社交活動" id="socialActivitiesCheckbox" name="job_description[]">
                        <label class="form-check-label" for="socialActivitiesCheckbox">參與客人交流和社交活動</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供當地文化和景點推薦" id="localRecommendationsCheckbox" name="job_description[]">
                        <label class="form-check-label" for="localRecommendationsCheckbox">提供當地文化和景點推薦</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人安排交通和行程" id="transportationArrangementCheckbox" name="job_description[]">
                        <label class="form-check-label" for="transportationArrangementCheckbox">協助客人安排交通和行程</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="參與園區或景點的維護工作" id="parkMaintenanceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="parkMaintenanceCheckbox">參與園區或景點的維護工作</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助組織和執行特別活動或主題派對" id="eventOrganizationCheckbox" name="job_description[]">
                        <label class="form-check-label" for="eventOrganizationCheckbox">協助組織和執行特別活動或主題派對</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供額外客房裝飾服務" id="roomDecorationCheckbox" name="job_description[]">
                        <label class="form-check-label" for="roomDecorationCheckbox">提供額外客房裝飾服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供簡單的烹飪或烤肉服務" id="cookingServiceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="cookingServiceCheckbox">提供簡單的烹飪或烤肉服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人購買或預訂特定項目或服務" id="purchaseAssistanceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="purchaseAssistanceCheckbox">協助客人購買或預訂特定項目或服務</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供客人個性化服務，根據其需求和喜好調整服務內容" id="personalizedServiceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="personalizedServiceCheckbox">提供客人個性化服務，根據其需求和喜好調整服務內容</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="提供健康和健身指導" id="healthAndFitnessGuidanceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="healthAndFitnessGuidanceCheckbox">提供健康和健身指導</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="協助客人處理緊急情況和醫療問題" id="emergencyAndMedicalAssistanceCheckbox" name="job_description[]">
                        <label class="form-check-label" for="emergencyAndMedicalAssistanceCheckbox">協助客人處理緊急情況和醫療問題</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="其他" id="authorCheckbox" name="job_description[]">
                        <label class="form-check-label" for="authorCheckbox">其他</label>
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label2 fw-bolder">店家提供:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="住宿" id="accommodation" name="benefits[]">
                        <label class="form-check-label" for="accommodation">住宿</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="伙食" id="meal" name="benefits[]">
                        <label class="form-check-label" for="meal">伙食</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="交通" id="transportation" name="benefits[]">
                        <label class="form-check-label" for="transportation">交通</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="健康保險" id="health_insurance" name="benefits[]">
                        <label class="form-check-label" for="health_insurance">健康保險</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工折扣" id="employee_discount" name="benefits[]">
                        <label class="form-check-label" for="employee_discount">員工折扣</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="員工活動" id="employee_activities" name="benefits[]">
                        <label class="form-check-label" for="employee_activities">員工活動</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="培訓和發展" id="training_development" name="benefits[]">
                        <label class="form-check-label" for="training_development">培訓和發展</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="彈性工作安排" id="flexible_work_schedule" name="benefits[]">
                        <label class="form-check-label" for="flexible_work_schedule">彈性工作安排</label>
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

