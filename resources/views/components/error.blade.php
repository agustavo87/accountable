@props(['for', 'nonSpecific' => false])

@error($for)
<p 
    {{ $attributes->merge(['class' => 'text-xs text-red-500'])}}
    @if($nonSpecific) 
        :class="dirty && 'hidden'"
    @else
        wire:target="{{$for}}"
    @endif
    wire:dirty.class="hidden" 
>
    {{$message}}
</p>
@enderror