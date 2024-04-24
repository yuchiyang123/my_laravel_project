@extends('layouts.layoutback')

@section('title', '申請打工')

@section('Form')
<form method="POST" action="/join_shop/submit/{{ $User_job_info->id }}">
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
                    <input type="text" name="contact_number" class="form-control" placeholder="請輸入聯繫電話" style="display: none;" value="{{ User_infor->phone }}">
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">期望的薪資待遇：</label>
                    <input type="text" name="expected_salary" class="form-control" placeholder="請輸入期望的薪資待遇" style="display: none;">
                    <select id="expected_salary" name="expected_salary" class="form-select">
                        <option value="$1000">$1000</option>
                        <option value="$2000">$2000</option>
                    </select>
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
                    <textarea name="motivation" class="form-control" placeholder="請輸入申請工作的動機"></textarea>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">可工作時間：</label>
                    <textarea name="availability" class="form-control" placeholder="請輸入可工作時間"></textarea>
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
                    <label class="post-title-label fw-bolder">工作經驗：</label>
                    <textarea name="work_experience" class="form-control" placeholder="請輸入工作經驗"></textarea>
                    <select id="conditions_exp" name="conditions_exp" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="不需要">不需要</option>
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
</script>
@endsection
