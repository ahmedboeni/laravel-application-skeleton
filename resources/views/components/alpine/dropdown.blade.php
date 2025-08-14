<div x-data="dropdown" class="relative">
    @isset($trigger)
        <div>
            {{ $trigger }}
        </div>
    @endisset
    
    @isset($content)
        {{ $content }}
    @endisset
</div> 