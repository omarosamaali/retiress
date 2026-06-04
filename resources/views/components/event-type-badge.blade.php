@props(['event'])

<span {{ $attributes->merge(['class' => 'event-type-badge '.$event->type_badge_class]) }}>
    {{ $event->type_label }}
</span>
