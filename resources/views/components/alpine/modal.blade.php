<div x-data="modal">
    @isset($trigger)
        <div>
            {{ $trigger }}
        </div>
    @endisset
    
    @isset($content)
        {{ $content }}
    @endisset
</div> 