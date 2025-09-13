@extends('layouts.admin')

@section('title', 'إدارة الرسائل')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-envelope fa-fw"></i>
            إدارة الرسائل
        </h1>
        <div class="d-flex gap-2">
            <span class="badge badge-danger badge-pill mr-2" style="display: flex; align-items: center; justify-content: center;" id="unread-count">
                {{ $unreadCount }} غير مقروءة
            </span>
            <button class="btn btn-primary btn-sm" onclick="refreshMessages()">
                <i class="fas fa-sync-alt"></i> تحديث
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                إجمالي الرسائل
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $messages->total() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                غير مقروءة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $unreadCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                الشكاوى
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $messages->where('type', 'complaint')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-frown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                الاقتراحات
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $messages->where('type', 'suggestion')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Messages Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">قائمة الرسائل</h6>
        </div>
        <div class="card-body">
            @if($messages->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="messagesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الهاتف</th>
                            <th>النوع</th>
                            <th>الحالة</th>
                            <th>التاريخ</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                            <td>
                                <strong>{{ $message->name }}</strong>
                                @if(!$message->is_read)
                                <span class="badge badge-danger badge-sm mr-1">جديد</span>
                                @endif
                            </td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->phone }}</td>
                            <td>
                                @switch($message->type)
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
                            </td>
                            <td>
                                @if($message->is_read)
                                <i class="fas fa-envelope-open text-success"></i> مقروءة
                                @else
                                <i class="fas fa-envelope text-warning"></i> غير مقروءة
                                @endif
                            </td>
                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}"
                                        class="btn btn-info btn-sm" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <form method="POST"
                                        action="{{ route('admin.contact-messages.toggle-read', $message) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            title="{{ $message->is_read ? 'وضع علامة غير مقروء' : 'وضع علامة مقروء' }}">
                                            <i
                                                class="fas {{ $message->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="حذف نهائياً">

                                            <i class="fas fa-trash"></i>
                                        </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-gray-400 mb-3"></i>
                <h5 class="text-gray-600">لا توجد رسائل</h5>
                <p class="text-gray-500">لم يتم العثور على أي رسائل مطابقة للفلاتر المحددة</p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

<script>

function refreshMessages() {
    window.location.reload();
}

// Auto-refresh every 30 seconds
setInterval(function() {
    const unreadBadge = document.getElementById('unread-count');
    fetch('{{ route("admin.contact-stats") }}')
        .then(response => response.json())
        .then(data => {
            unreadBadge.textContent = data.unread + ' غير مقروءة';
        })
        .catch(error => console.log('Error:', error));
}, 30000);
</script>

