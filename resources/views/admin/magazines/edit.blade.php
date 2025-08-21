@extends('layouts.admin')

@section('title', 'تعديل الالإنجاز')
@section('page-title', 'تعديل الالإنجاز')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل الإنجاز</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="member_id">اسم العضو</label>
                            <select name="member_id" id="member_id" class="form-control select2" required>
                                <option value="">اختر العضو</option>
                                @foreach($member_applications as $member)
                                <option value="{{ $member->id }}" {{ $magazine->member_id == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('member_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="title_ar">عنوان الالإنجاز (عربي)</label>
                            <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{ old('title_ar', $magazine->title_ar) }}" required>
                            @error('title_ar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="description_ar">الوصف (عربي)</label>
                            <textarea name="description_ar" id="description_ar" class="form-control" rows="5" required>{{ old('description_ar', $magazine->description_ar) }}</textarea>
                            @error('description_ar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">الحالة</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ old('status', $magazine->status) == 1 ? 'selected' : '' }}>نشط</option>
                                <option value="0" {{ old('status', $magazine->status) == 0 ? 'selected' : '' }}>غير نشط</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="main_image">الصورة الرئيسية</label>
                            <input type="file" name="main_image" id="main_image" class="form-control-file">
                            @error('main_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if($magazine->main_image)
                            <div class="mt-2">
                                <p>الصورة الحالية:</p>
                                <img src="{{ asset('storage/' . $magazine->main_image) }}" alt="الصورة الرئيسية" style="max-width: 200px; height: auto;">
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label for="sub_images">الصور الفرعية</label>
                            <input type="file" name="sub_images[]" id="sub_images" class="form-control-file" multiple>
                            @error('sub_images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if($magazine->sub_image)
                            <div class="mt-2">
                                <p>الصور الفرعية الحالية:</p>
                                <div class="d-flex flex-wrap">
                                    @foreach(json_decode($magazine->sub_image, true) as $sub_image)
                                    <img src="{{ asset('storage/' . $sub_image) }}" alt="صورة فرعية" style="max-width: 100px; height: auto; margin-right: 10px;">
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">تحديث الإنجاز</button>
                        <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
