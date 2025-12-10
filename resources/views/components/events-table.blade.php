<style>
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
        padding: 15px;
        border: 1px solid #d4edda
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f4f7f9;
        color: black;
        padding: 15px;
        text-align: center;
        font-weight: 600;
    }

    td{
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .paid {
        background: #e8f5e8;
        color: #2d5a2d;
    }

    .free {
        background: #fff3cd;
        color: #856404;
    }

    .active {
        background: #d4edda;
        color: #155724;
    }

    .inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .preview-btn {
        background: #17a2b8;
        color: white;
        border: none;
        padding: 3px 8px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .preview-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 172, 254, 0.4);
    }

    .product-name {
        font-weight: 600;
        color: #333;
    }

    .title-table {
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    tr{
        transition: background-color 0.2s ease;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
</style>

<div class="table-container">
    <div class="table-header">
        <h3 class="title-table">أحدث البرامج والفعاليات</h3
        @if(Auth::user()->role == 'مدير')
        <a href="{{ route('admin.event.index') }}" class="preview-btn">إنشاء فعالية</a>
        @endif
    </div>
        <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الصورة</th>
                <th>النوع</th>
                <th>الحالة</th>
                <th>المعاينة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td class="product-name">{{ Str::limit($event->title_ar, 10) }}</td>

                <td>
                    <img src="{{ asset('storage/' . $event->main_image) }}" alt="صورة المنتج" class="product-image">
                </td>
                <td>
                    <span class="status-badge paid" style="font-weight: 700;">{{ $event->is_payed == '1' ? 'مجاني' :
                        'مدفوع' }}
                        @if ($event->price)
                        -
                        {{ $event->price }}
                        درهم
                        @endif
                    </span>
                </td>
                <td>
                    <span class="status-badge active" style="font-weight: 700; {{ $event->status == '1' ? 'background-color: #d4edda; color: #155724;' : 'background-color: #f8d7da; color: #721c24;' }}">{{
                        $event->status == '1' ? 'فعال' : 'غير فعال' }}</span>
                </td>
                <td>
                    <a class="preview-btn" href="{{ route('admin.event.show', $event->id) }}">
                        <i style="z-i" class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
