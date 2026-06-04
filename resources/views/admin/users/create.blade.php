@extends('layouts.admin')

@section('title', 'تسجيل عضو جديد')
@section('page-title', 'تسجيل عضو جديد')

@push('styles')
    <style>
        .user-details-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .detail-item { margin-bottom: 20px; }

        .detail-label {
            font-weight: 600;
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 1.05rem;
            color: #333;
            background-color: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
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

        .back-btn:hover { background: #545b62; color: white; }

        .edit-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn:hover { background: #218838; }
    </style>
@endpush

@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-user-plus ms-2 text-primary"></i>
            <h4 class="mb-0">تسجيل عضو جديد</h4>
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

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="register_as_member" value="1">

            <h5 class="section-title">
                <i class="fas fa-user ms-2"></i>
                بيانات الحساب
            </h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الاسم (يُستخدم أيضاً كاسم كامل في العضوية):</span>
                        <input type="text" class="form-control" name="name" id="account-name"
                            value="{{ old('name', old('full_name')) }}" required>
                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">البريد الإلكتروني:</span>
                        <input type="email" class="form-control" name="email" id="account-email"
                            value="{{ old('email', old('membership_email')) }}" required>
                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">كلمة السر:</span>
                        <input type="password" class="form-control" name="password" required>
                        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">حالة الحساب:</span>
                        <select class="form-select" name="status" required>
                            <option value="فعال" {{ old('status', 'فعال') == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="غير فعال" {{ old('status') == 'غير فعال' ? 'selected' : '' }}>غير فعال</option>
                            <option value="بانتظار التفعيل" {{ old('status') == 'بانتظار التفعيل' ? 'selected' : '' }}>بانتظار التفعيل</option>
                            <option value="بإنتظار إستكمال البيانات" {{ old('status') == 'بإنتظار إستكمال البيانات' ? 'selected' : '' }}>بإنتظار إستكمال البيانات</option>
                        </select>
                        @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            @include('admin.users.partials.membership-edit-form')

            <div class="btn-section mt-4">
                <a href="{{ route('admin.users.index') }}" class="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    إلغاء
                </a>
                <button type="submit" class="edit-btn">
                    <i class="fas fa-save ms-1"></i>
                    تسجيل العضو
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accountName = document.getElementById('account-name');
            const accountEmail = document.getElementById('account-email');
            const fullName = document.querySelector('[name="full_name"]');
            const membershipEmail = document.querySelector('[name="membership_email"]');

            function syncAccountToMembership() {
                if (fullName && accountName && !fullName.value) {
                    fullName.value = accountName.value;
                }
                if (membershipEmail && accountEmail && !membershipEmail.value) {
                    membershipEmail.value = accountEmail.value;
                }
            }

            accountName?.addEventListener('blur', function() {
                if (fullName && !fullName.value) fullName.value = this.value;
            });
            accountEmail?.addEventListener('blur', function() {
                if (membershipEmail && !membershipEmail.value) membershipEmail.value = this.value;
            });

            syncAccountToMembership();

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
