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

</style>

<div class="table-container">
    <div class="table-header">
        <h3 class="title-table">أحدث الخدمات</h3>
        @if(Auth::user()->role == 'مدير')
        <a href="{{ route('admin.services.create') }}" class="preview-btn">إنشاء خدمة</a>
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
            @foreach ($services as $service)
            <tr>
                <td class="product-name">{{ $service->name_ar }}</td>
                <td>
                    <img src="{{ asset('storage/' . $service->image) }}" alt="صورة المنتج" class="product-image">
                </td>
                <td>
                    <span class="status-badge paid" style="font-weight: 700;">{{ $service->is_payed == '1' ? 'مجاني' :
                        'مدفوع' }}
                        @if ($service->price)
                        -
                        {{ $service->price }}
                        درهم
                        @endif
                    </span>
                </td>
                <td>
                    <span class="status-badge active" style="font-weight: 700; {{ $service->status == '1' ? 'background-color: #d4edda; color: #155724;' : 'background-color: #f8d7da; color: #721c24;' }}">{{
                        $service->status == '1' ? 'فعال' : 'غير فعال' }}</span>
                </td>
                <td>
                    <a class="preview-btn" href="{{ route('admin.services.show', $service->id) }}">
                        <i style="z-i" class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>