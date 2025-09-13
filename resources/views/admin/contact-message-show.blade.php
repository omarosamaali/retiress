{{-- resources/views/admin/contact-message-show.blade.php --}}
@extends('layouts.admin')
@section('title', 'عرض الرسالة')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-envelope-open"></i>
            عرض الرسالة
        </h1>
        <div>
            <a href="{{ route('admin.contact-messages') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> العودة للقائمة
            </a>
        </div>
    </div>

    <!-- Message Details Card -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">تفاصيل الرسالة</h6>
                    <div>
                        @if(!$contactMessage->is_read)
                        <span class="badge badge-warning">غير مقروء</span>
                        @else
                        <span class="badge badge-success">مقروء</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="message-header mb-4 p-3 bg-light rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>من:</strong> {{ $contactMessage->name }}<br>
                                <strong>البريد الإلكتروني:</strong>
                                <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a><br>
                                <strong>الهاتف:</strong>
                                <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                            </div>
                            <div class="col-md-6">
                                <strong>نوع الرسالة:</strong>
                                @switch($contactMessage->type)
                                @case('complaint')
                                <span class="badge badge-danger">شكوى</span>
                                @break
                                @case('suggestion')
                                <span class="badge badge-success">اقتراح</span>
                                @break
                                @case('other')
                                <span class="badge badge-info">أخرى</span>
                                @break
                                @endswitch
                                <br>
                                <strong>تاريخ الإرسال:</strong> {{ $contactMessage->created_at->format('Y-m-d H:i')
                                }}<br>
                                @if($contactMessage->read_at)
                                <strong>تاريخ القراءة:</strong> {{ $contactMessage->read_at->format('Y-m-d H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="message-content">
                        <h6 class="font-weight-bold mb-3">نص الرسالة:</h6>
                        <div class="p-3 border rounded bg-white" style="min-height: 200px;">
                            {!! nl2br(e($contactMessage->message)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">الإجراءات</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        {{--
                        <!-- Reply via Email -->
                        <a href="mailto:{{ $contactMessage->email }}?subject=رد على: {{ $contactMessage->type_in_arabic }}&body=عزيزي/عزيزتي {{ $contactMessage->name }},%0A%0A"
                            class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-reply"></i> رد عبر البريد الإلكتروني
                        </a> --}}

                        <!-- Call -->
                        <a href="tel:{{ $contactMessage->phone }}" class="btn btn-success btn-block mb-2">
                            <i class="fas fa-phone"></i> اتصال هاتفي
                        </a>

                        <!-- Toggle Read Status -->
                        {{-- <form method="POST"
                            action="{{ route('admin.contact-messages.toggle-read', $contactMessage) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning btn-block mb-2">
                                @if($contactMessage->is_read)
                                <i class="fas fa-envelope"></i> وضع علامة غير مقروء
                                @else
                                <i class="fas fa-envelope-open"></i> وضع علامة مقروء
                                @endif
                            </button>
                        </form> --}}


                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="حذف نهائياً">
                                حذف الرسالة
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Message Info -->
                    <hr>
                    <div class="text-muted small">
                        <div class="mb-2">
                            <i class="fas fa-clock"></i>
                            <strong>مرسلة منذ:</strong> {{ $contactMessage->created_at->diffForHumans() }}
                        </div>
                        @if($contactMessage->read_at)
                        <div class="mb-2">
                            <i class="fas fa-eye"></i>
                            <strong>قرأت منذ:</strong> {{ $contactMessage->read_at->diffForHumans() }}
                        </div>
                        @endif
                        <div>
                            <i class="fas fa-hashtag"></i>
                            <strong>رقم الرسالة:</strong> #{{ $contactMessage->id }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">إحصائيات سريعة</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                رسائل اليوم
                            </div>
                            <div class="h6 mb-0 font-weight-bold">
                                {{ App\Models\ContactMessage::whereDate('created_at', today())->count() }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                غير مقروءة
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-warning">
                                {{ App\Models\ContactMessage::unread()->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    تأكيد الحذف
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-trash fa-3x text-danger mb-3"></i>
                    <h6>هل أنت متأكد من حذف هذه الرسالة؟</h6>
                    <p class="text-muted">
                        رسالة من: <strong>{{ $contactMessage->name }}</strong><br>
                        البريد: <strong>{{ $contactMessage->email }}</strong>
                    </p>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        لا يمكن التراجع عن هذا الإجراء!
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> إلغاء
                </button>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="حذف نهائياً">

                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function confirmDelete() {
    $('#deleteModal').modal('show');
}
</script>
@endsection