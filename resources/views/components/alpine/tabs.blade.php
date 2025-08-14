<div x-data="tabs({{ $defaultTab ?? 0 }})">
    @isset($tabs)
        {{ $tabs }}
    @endisset
    
    @isset($content)
        {{ $content }}
    @endisset
</div> 