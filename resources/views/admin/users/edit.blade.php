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
            font-size: 1.05rem;
            color: #333;
            background-color: #f8f9fa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0e6939;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .image-preview {
            max-width: 200px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #0e6939;
            margin-bottom: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
            display: inline-block;
        }

        .back-btn:hover {
            background: #545b62;
            color: white;
        }

        .edit-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn:hover {
            background: #218838;
        }
    </style>
@endpush

@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تعديل مستخدم: {{ $user->name }}</h4>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="section-title">
                <i class="fas fa-user ms-2"></i>
                بيانات الحساب
            </h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الاسم:</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">البريد الإلكتروني (الحساب):</span>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
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
                            <option value="أمين الصندوق" {{ old('role', $user->role) == 'أمين الصندوق' ? 'selected' : '' }}>أمين الصندوق</option>
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
                        <span class="detail-label">حالة الحساب:</span>
                        <select class="form-select" name="status" id="status" required>
                            <option value="فعال" {{ old('status', $user->status) == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="غير فعال" {{ old('status', $user->status) == 'غير فعال' ? 'selected' : '' }}>غير فعال</option>
                            <option value="بانتظار التفعيل" {{ old('status', $user->status) == 'بانتظار التفعيل' ? 'selected' : '' }}>بانتظار التفعيل</option>
                            <option value="بإنتظار إستكمال البيانات" {{ old('status', $user->status) == 'بإنتظار إستكمال البيانات' ? 'selected' : '' }}>بإنتظار إستكمال البيانات</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            @if ($user->memberApplication)
                @include('admin.users.partials.membership-edit-form')
            @else
                <div class="alert alert-secondary mt-5">
                    <i class="fas fa-info-circle ms-2"></i>
                    لا يوجد طلب عضوية لهذا المستخدم. يمكن إدارته من
                    <a href="{{ route('admin.manageMembership.index') }}">إدارة طلبات العضوية</a>.
                </div>
            @endif

            <div class="btn-section mt-4">
                <a href="{{ route('admin.users.show', $user->id) }}" class="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    إلغاء
                </a>
                <button type="submit" class="edit-btn">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection

@if ($user->memberApplication)
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function addExperienceRow(containerId, fieldPrefix) {
                    const container = document.getElementById(containerId);
                    const index = container.querySelectorAll('.experience-row').length;
                    const row = document.createElement('div');
                    row.className = 'row experience-row mb-2';
                    row.innerHTML = `
                        <div class="col-md-3"><input type="text" class="form-control" name="${fieldPrefix}[${index}][year]" placeholder="السنة"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="${fieldPrefix}[${index}][job_title]" placeholder="المسمى"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="${fieldPrefix}[${index}][employer]" placeholder="جهة العمل"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="${fieldPrefix}[${index}][years_of_experience]" placeholder="سنوات الخبرة"></div>
                    `;
                    container.appendChild(row);
                }

                document.getElementById('add-professional-experience')?.addEventListener('click', function() {
                    addExperienceRow('professional-experiences', 'professional_experiences');
                });

                document.getElementById('add-previous-experience')?.addEventListener('click', function() {
                    addExperienceRow('previous-experiences', 'previous_experience');
                });
            });
        </script>
    @endpush
@endif
