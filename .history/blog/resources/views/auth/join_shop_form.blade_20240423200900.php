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
                    <input type="text" name="name" class="form-control" placeholder="請輸入姓名" style="display: none;">
                    <select id="name" name="name" class="form-select">
                        <option value="John">John</option>
                        <option value="Jane">Jane</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者電子郵件地址：</label>
                    <input type="email" name="email" class="form-control" placeholder="請輸入電子郵件" style="display: none;">
                    <select id="email" name="email" class="form-select">
                        <option value="john@example.com">john@example.com</option>
                        <option value="jane@example.com">jane@example.com</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">申請者聯繫電話：</label>
                    <input type="text" name="contact_number" class="form-control" placeholder="請輸入聯繫電話" style="display: none;">
                    <select id="contact_number" name="contact_number" class="form-select">
                        <option value="123456789">123456789</option>
                        <option value="987654321">987654321</option>
                    </select>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">期望申請的工作類型：</label>
                    <select id="job_type" name="job_type" class="form-select">
                        <option value="part_time">兼職</option>
                        <option value="full_time">全職</option>
                    </select>
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
                    <label class="post-title-label fw-bolder">申請者的個性描述：</label>
                    <textarea name="personality" class="form-control" placeholder="請輸入個性描述"></textarea>
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
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">教育背景：</label>
                    <textarea name="educational_background" class="form-control" placeholder="請輸入教育背景"></textarea>
                </div>
                <div class="mb-3 text-start">
                    <label class="post-title-label fw-bolder">工作經驗：</label>
                    <textarea name="work_experience" class="form-control" placeholder="請輸入工作經驗"></textarea>
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
