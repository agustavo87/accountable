@if ($errors->any())
<div>
    <ul class="list-disc bg-opacity-80 bg-red-200 mx-1 my-2 px-3 py-2 rounded-lg text-red-500 text-xs">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif