@extends('layouts.admin')

@section('title', 'إرسال إشعار فوري')
@section('page-title', 'إرسال إشعار فوري')

@section('content')
<style>
    .notif-wrap {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 900px) { .notif-wrap { grid-template-columns: 1fr; } }

    /* ── Audience toggle ── */
    .aud-toggle {
        display: flex;
        gap: 10px;
        margin-bottom: 18px;
    }
    .aud-btn {
        flex: 1;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 10px;
        cursor: pointer;
        text-align: center;
        transition: all .18s;
        background: #fff;
        user-select: none;
    }
    .aud-btn i { display: block; font-size: 1.4rem; margin-bottom: 4px; color: #94a3b8; }
    .aud-btn span { font-size: .85rem; color: #64748b; font-weight: 600; }
    .aud-btn.selected { border-color: #016330; background: #f0fdf4; }
    .aud-btn.selected i, .aud-btn.selected span { color: #016330; }

    /* ── Member picker ── */
    .mpick-wrap { display: none; }
    .mpick-wrap.active { display: block; }

    .mpick-search {
        position: relative;
        margin-bottom: 8px;
    }
    .mpick-search input {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 34px 8px 10px;
        font-size: .875rem;
        outline: none;
        font-family: inherit;
    }
    .mpick-search input:focus { border-color: #016330; }
    .mpick-search i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: .8rem;
    }

    .mpick-list {
        max-height: 220px;
        overflow-y: auto;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
    }
    .mpick-list::-webkit-scrollbar { width: 4px; }
    .mpick-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

    .mpick-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        cursor: pointer;
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s;
        font-size: .875rem;
    }
    .mpick-item:last-child { border-bottom: none; }
    .mpick-item:hover { background: #f8fafc; }
    .mpick-item input[type=checkbox] { accent-color: #016330; width: 15px; height: 15px; flex-shrink: 0; cursor: pointer; }
    .mpick-item.checked { background: #f0fdf4; }
    .mpick-item--hidden { display: none; }

    .mpick-selected-count {
        font-size: .8rem;
        color: #016330;
        font-weight: 600;
        margin-top: 6px;
        min-height: 18px;
    }

    /* ── Recent list ── */
    .recent-item {
        padding: 12px 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .recent-item:last-child { border-bottom: none; }
    .recent-item__title { font-weight: 600; font-size: .9rem; color: #1e293b; }
    .recent-item__body { font-size: .82rem; color: #64748b; margin: 2px 0 4px; }
    .recent-item__meta { font-size: .78rem; color: #94a3b8; }
</style>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="notif-wrap">

    {{-- ── Form ── --}}
    <div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.member-notifications.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="audience" id="audience-input" value="all">

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">عنوان الإشعار</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required maxlength="255" placeholder="مثال: تذكير بموعد الفعالية">
                        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Body --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">نص الإشعار</label>
                        <textarea name="body" class="form-control" rows="4" required maxlength="5000" placeholder="اكتب محتوى الإشعار هنا...">{{ old('body') }}</textarea>
                        @error('body') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Audience toggle --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">إرسال إلى</label>
                        <div class="aud-toggle">
                            <div class="aud-btn selected" id="btn-all" onclick="setAudience('all')">
                                <i class="fa-solid fa-users"></i>
                                <span>جميع الأعضاء</span>
                            </div>
                            <div class="aud-btn" id="btn-specific" onclick="setAudience('specific')">
                                <i class="fa-solid fa-user-check"></i>
                                <span>أعضاء محددون</span>
                            </div>
                        </div>
                    </div>

                    {{-- Member picker --}}
                    <div class="mpick-wrap mb-3" id="mpick-wrap">
                        <label class="form-label fw-semibold">اختر الأعضاء</label>
                        <div class="mpick-search">
                            <input type="text" id="mpick-search" placeholder="ابحث باسم العضو...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="mpick-list" id="mpick-list">
                            @foreach($members as $member)
                            <label class="mpick-item" data-name="{{ mb_strtolower($member->name) }}">
                                <input type="checkbox" name="user_ids[]" value="{{ $member->id }}"
                                    {{ in_array($member->id, old('user_ids', [])) ? 'checked' : '' }}>
                                {{ $member->name }}
                            </label>
                            @endforeach
                        </div>
                        <div class="mpick-selected-count" id="mpick-count"></div>
                        @error('user_ids') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane ms-1"></i>
                        إرسال الإشعار
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ── Recent ── --}}
    <div>
        <div class="card">
            <div class="card-header fw-semibold">
                <i class="fa-solid fa-clock-rotate-left me-1"></i> آخر الإشعارات
            </div>
            @if($recent->isNotEmpty())
            <div>
                @foreach($recent as $item)
                <div class="recent-item" style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
                    <div style="flex:1;min-width:0;">
                        <div class="recent-item__title">{{ $item->title }}</div>
                        <div class="recent-item__body">{{ Str::limit($item->body, 80) }}</div>
                        <div class="recent-item__meta">
                            <i class="fa-regular fa-clock"></i>
                            {{ $item->sent_at?->format('d/m/Y H:i') }}
                            @if($item->creator) &mdash; {{ $item->creator->name }} @endif
                        </div>
                    </div>
                    <a href="{{ route('admin.member-notifications.show', $item->id) }}"
                       class="btn btn-sm btn-outline-primary flex-shrink-0" style="font-size:.75rem;padding:3px 10px;" title="عرض التفاصيل">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="card-body text-muted small">لا توجد إشعارات سابقة.</div>
            @endif
            <div class="card-footer text-center" style="padding:10px;">
                <a href="{{ route('admin.member-notifications.index') }}"
                   class="btn btn-sm btn-outline-secondary w-100">
                    <i class="fa-solid fa-list me-1"></i> عرض جميع الإشعارات
                </a>
            </div>
        </div>
    </div>

</div>

<script>
function setAudience(val) {
    document.getElementById('audience-input').value = val;
    document.getElementById('btn-all').classList.toggle('selected', val === 'all');
    document.getElementById('btn-specific').classList.toggle('selected', val === 'specific');
    document.getElementById('mpick-wrap').classList.toggle('active', val === 'specific');
}

// Search members
document.getElementById('mpick-search').addEventListener('input', function () {
    const q = this.value.trim().toLowerCase();
    document.querySelectorAll('#mpick-list .mpick-item').forEach(el => {
        el.classList.toggle('mpick-item--hidden', q && !el.dataset.name.includes(q));
    });
});

// Highlight checked + count
function updateCount() {
    const checked = document.querySelectorAll('#mpick-list input:checked').length;
    document.getElementById('mpick-count').textContent = checked > 0 ? `✓ تم اختيار ${checked} عضو` : '';
    document.querySelectorAll('#mpick-list .mpick-item').forEach(el => {
        el.classList.toggle('checked', el.querySelector('input').checked);
    });
}
document.querySelectorAll('#mpick-list input[type=checkbox]').forEach(cb => {
    cb.addEventListener('change', updateCount);
});

// Restore state on validation error
@if(old('audience') === 'specific') setAudience('specific'); @endif
updateCount();
</script>
@endsection
