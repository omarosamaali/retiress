@extends('layouts.admin')

@section('title', 'تعديل المستخدم')
@section('page-title', 'تعديل المستخدم')

@push('styles')
    <style>
        .user-details-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .detail-value,
        .form-control {
            font-size: 1.05rem;
            color: #333;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 10px 15px;
            border-radius: 8px;
            word-wrap: break-word;
        }

        .detail-value.badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .5em .75em;
            font-size: 0.9em;
            font-weight: bold;
        }

        .image-preview {
            max-width: 300px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .chef-fields {
            display: none;
        }
    </style>
@endpush


@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تعديل مستخدم: {{ $user->name }}</h4>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الاسم:</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">البريد الإلكتروني:</span>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                            required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">كلمة السر (اتركها فارغة إذا لم تكن تريد التغيير):</span>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الصلاحية:</span>
                        <select class="form-select" name="role" id="role" required>
                            <option value="مدير" {{ old('role', $user->role) == 'مدير' ? 'selected' : '' }}>مدير</option>
                            <option value="موظف استقبال" {{ old('role', $user->role) == 'موظف استقبال' ? 'selected' : '' }}>موظف استقبال</option>
                            <option value="أمين سر" {{ old('role', $user->role) == 'أمين سر' ? 'selected' : '' }}>أمين سر</option>
                            <option value="عضو" {{ old('role', $user->role) == 'عضو' ? 'selected' : '' }}>عضو</option>
                            <option value="مدخل بيانات" {{ old('role', $user->role) == 'مدخل بيانات' ? 'selected' : '' }}>مدخل بيانات</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الحالة:</span>
                        <select class="form-select" name="status" id="status" required>
                            <option value="فعال" {{ old('status', $user->status) == 'فعال' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="غير فعال" {{ old('status', $user->status) == 'غير فعال' ? 'selected' : '' }}>غير
                                فعال</option>
                            <option value="بانتظار التفعيل"
                                {{ old('status', $user->status) == 'بانتظار التفعيل' ? 'selected' : '' }}>بانتظار التفعيل
                            </option>
                            <option value="بإنتظار إستكمال البيانات"
                                {{ old('status', $user->status) == 'بإنتظار إستكمال البيانات' ? 'selected' : '' }}>بإنتظار
                                إستكمال البيانات</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="btn-section mt-4">
                <a href="{{ route('admin.users.index') }}" class="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    العودة لقائمة المستخدمين
                </a>
                <button type="submit" class="edit-btn">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const chefFields = document.getElementById('chef-fields');
            const contractTypeSelect = document.getElementById(
            'contract_type_select'); // احصل على عنصر select لنوع التعاقد
            const subscriptionFields = document.getElementById('subscription-fields'); // احصل على div حقول الاشتراك

            // دالة لتبديل عرض حقول الطاهي
            function toggleChefFields() {
                if (roleSelect.value === 'طاه') {
                    chefFields.style.display = 'block';
                    toggleSubscriptionFields(); // استدعاء لتبديل حقول الاشتراك عند عرض حقول الطاهي
                } else {
                    chefFields.style.display = 'none';
                    subscriptionFields.style.display = 'none'; // إخفاء حقول الاشتراك إذا لم يكن الدور "طاه"
                }
            }

            // دالة لتبديل عرض حقول الاشتراك
            function toggleSubscriptionFields() {
                if (contractTypeSelect.value === 'annual_subscription') {
                    subscriptionFields.style.display = 'block';
                } else {
                    subscriptionFields.style.display = 'none';
                }
            }

            // استدعاء الدالة عند تحميل الصفحة للحالة الأولية
            toggleChefFields();

            // إضافة مستمع للأحداث عند تغيير الصلاحية
            roleSelect.addEventListener('change', toggleChefFields);

            // إضافة مستمع للأحداث عند تغيير نوع التعاقد
            contractTypeSelect.addEventListener('change', toggleSubscriptionFields);
        });
    </script>
@endpush
