<!-- resources/views/components/admin/sidebar/item.blade.php -->
@props(['url' => '', 'fa_type', 'active'=>false])

@php
    $class_for_merge = "opacity-75 hover:opacity-100";
    if ($active) {
        $class_for_merge = "active-nav-link";
    }
@endphp

<a {{ $attributes->merge([
        'href' => $url, 
        'class' => 'flex items-center text-white py-4 pl-6 nav-item '.$class_for_merge
        ]) 
    }}>
    <i {{ $attributes->merge([
        'class' => 'mr-3 fas fa-'.$fa_type
        ]) 
    }}></i>
    {{ $slot }}
</a>
