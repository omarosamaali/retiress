@php
    $selectedAudience = old('audience', $selectedAudience ?? \App\Models\Event::AUDIENCE_ALL);
@endphp
<div class="mb-3">
    <label for="audience" class="form-label {{ $labelClass ?? '' }}">الفئة المستهدفة</label>
    <select class="form-select" name="audience" id="audience" required>
        @foreach (\App\Models\Event::AUDIENCES as $audienceOption)
            <option value="{{ $audienceOption }}" {{ $selectedAudience == $audienceOption ? 'selected' : '' }}>{{ $audienceOption }}</option>
        @endforeach
    </select>
    @error('audience')
        <div class="{{ $errorClass ?? 'text-danger' }}">{{ $message }}</div>
    @enderror
</div>
