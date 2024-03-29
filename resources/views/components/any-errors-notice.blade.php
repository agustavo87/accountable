@if($errors->any())
<div {{ $attributes->merge(['class' => "rounded-md bg-red-100 p-4"])}}>
  <div class="flex">
    <div class="flex-shrink-0">

      <x-icons.x-solid-circle class="h-5 w-5 text-red-600" />

    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-red-800">
        Please fix the following error(s)
      </h3>
      <div class="mt-2 text-sm text-red-600">
        <ul role="list" class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endif