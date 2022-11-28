@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-8 hover:bg-gray-300 focus:bg-gray-300 cursor-pointer';
    $active ? $classes .= ' bg-gray-300' : '';
@endphp

<a
    {{ $attributes([
        'class' => $classes
    ]) }}
>
    {{ $slot }}
</a>