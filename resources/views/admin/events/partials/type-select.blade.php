@php
    $selectedType = old('type', $selectedType ?? 'فعالية');
@endphp
<div class="mb-3">
    <label for="type" class="form-label {{ $labelClass ?? '' }}">النوع</label>
    <select class="form-select" name="type" id="type" required>
        @foreach (\App\Models\Event::TYPES as $eventType)
            <option value="{{ $eventType }}" {{ $selectedType == $eventType ? 'selected' : '' }}>{{ $eventType }}</option>
        @endforeach
    </select>
    @error('type')
        <div class="{{ $errorClass ?? 'text-danger' }}">{{ $message }}</div>
    @enderror
</div>
