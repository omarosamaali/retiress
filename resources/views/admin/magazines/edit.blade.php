@extends('layouts.admin')

@section('title', 'تعديل المقال')
@section('page-title', 'تعديل المقال')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: 160px; font-family: 'Cairo', sans-serif; font-size: 1rem; direction: rtl; text-align: right; }
    .ql-toolbar.ql-snow { direction: ltr; }
    .ql-container.ql-snow { border-radius: 0 0 8px 8px; }
    .ql-toolbar.ql-snow { border-radius: 8px 8px 0 0; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل المقال</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.magazines.update', $magazine->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="name">اسم العضو</label>
                            <input type="text" name="name" id="title_ar" class="form-control"
                                value="{{ old('name', $magazine->name) }}" required> @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="title_ar">عنوان المقال (عربي)</label>
                            <input type="text" name="title_ar" id="title_ar" class="form-control"
                                value="{{ old('title_ar', $magazine->title_ar) }}" required>
                            @error('title_ar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>الوصف (عربي)</label>
                            <div id="quill_description_ar"></div>
                            <textarea name="description_ar" id="description_ar" style="display:none;"
                                required>{{ old('description_ar', $magazine->description_ar) }}</textarea>
                            @error('description_ar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">الحالة</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ old('status', $magazine->status) == 1 ? 'selected' : '' }}>نشط
                                </option>
                                <option value="0" {{ old('status', $magazine->status) == 0 ? 'selected' : '' }}>غير نشط
                                </option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="image">صورة العضو</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if($magazine->image)
                            <div class="mt-2">
                                <p>الصورة الحالية:</p>
                                <img src="{{ asset('storage/' . $magazine->image) }}" alt="الصورة الرئيسية"
                                    style="width: 100px; height: 100px; border-radius: 50%;">
                            </div>
                            @endif
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
                                <img src="{{ asset('storage/' . $magazine->main_image) }}" alt="الصورة الرئيسية"
                                    style="max-width: 200px; height: auto;">
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
                                    <img src="{{ asset('storage/' . $sub_image) }}" alt="صورة فرعية"
                                        style="max-width: 100px; height: auto; margin-right: 10px;">
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">تحديث المقال</button>
                        <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#quill_description_ar', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    [{ 'color': [] }],
                    ['clean']
                ]
            }
        });
        var ta = document.getElementById('description_ar');
        quill.root.innerHTML = ta.value;
        document.querySelector('form').addEventListener('submit', function() {
            ta.value = quill.root.innerHTML;
        });
    });
</script>
@endpush