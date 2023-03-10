@props([
    'id' => ''
])
<div>
    <label {{ $label->attributes->merge([
        'for' => $id,
        'class' => 'block text-sm font-medium text-gray-700'
    ])}}>
        {{ $label }}
    </label>
    <div class="mt-1">
        <textarea 
            id="{{ $id }}" 
            {{ $attributes->merge([
                'rows' => 3,
                'name' => $id,
                'class' => 'mt-1 block w-full border-0 border-b border-gray-300 rounded-sm bg-gray-50 shadow-sm focus:bg-deep-white focus:text-deep-dark placeholder-gray-400  focus:placeholder-deep-white-3 transition focus:border-turquoise focus:ring-0 sm:text-sm'
            ]) }}
        >{{$slot}}</textarea>
    </div>
    @if($hint)
        <p {{ $hint->attributes->merge(['class' => 'mt-1 ml-1 text-sm text-gray-400']) }}>
            {{ $hint }}
        </p>
    @endif
    @if($bind = $attributes->wire('model')->value())
        <x-error :for="$bind" />
    @endif
</div>