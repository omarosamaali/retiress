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
