@php
    $event = $event ?? null;
    $errorClass = $errorClass ?? 'text-danger';
@endphp

<div class="col-md-6">
    <div class="mb-3">
        <label for="starts_at" class="form-label">{{ __('app.event_starts_at') }}</label>
        <input type="datetime-local" class="form-control" id="starts_at" name="starts_at"
            value="{{ old('starts_at', $event && $event->starts_at ? $event->starts_at->format('Y-m-d\TH:i') : '') }}">
        @error('starts_at')
            <div class="{{ $errorClass }}">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
        <label for="ends_at" class="form-label">{{ __('app.event_ends_at') }}</label>
        <input type="datetime-local" class="form-control" id="ends_at" name="ends_at"
            value="{{ old('ends_at', $event && $event->ends_at ? $event->ends_at->format('Y-m-d\TH:i') : '') }}">
        @error('ends_at')
            <div class="{{ $errorClass }}">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
        <label for="subscription_deadline" class="form-label">
            <i class="fas fa-hourglass-end text-warning me-1"></i>
            آخر موعد للتسجيل
            <small class="text-muted">(اختياري)</small>
        </label>
        <input type="datetime-local" class="form-control" id="subscription_deadline" name="subscription_deadline"
            value="{{ old('subscription_deadline', $event && $event->subscription_deadline ? $event->subscription_deadline->format('Y-m-d\TH:i') : '') }}">
        <div class="form-text text-muted" style="font-size:.78rem;">
            بعد هذا الوقت سيتوقف زر الاشتراك تلقائياً
        </div>
        @error('subscription_deadline')
            <div class="{{ $errorClass }}">{{ $message }}</div>
        @enderror
    </div>
</div>
