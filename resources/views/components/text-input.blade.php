@props(['disabled' => false,
'label' => '',
'name' => '',
'id' => '',
'icon' => '',
'placeholder' => '',
'value' => '',
'ariaInvalid' => false,
'ariaDescribedBy' => '',
'type' => 'text',

])

<div>
    <label for="{{$id}}" class="block text-sm/6 font-medium text-gray-900">{{ $label }}</label>
    <div class="relative mt-2 rounded-md shadow-sm">
        <input @disabled($disabled)
            type="{{$type}}"
            name="{{$name}}"
            id="{{$id}}"

            {{ $attributes->merge([
                'class' => 'block w-full rounded-md border-0 px-2 py-1.5 pr-10 text-red-900 ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm/6'
                ]) }}

            placeholder="{{$placeholder}}"
            value="{{$value}}"
            aria-invalid="{{$ariaInvalid}}"
            aria-describedby="{{$ariaDescribedBy}}">

        @error($name)
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="size-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror
    </div>
    
    @error($name)
    <p class="mt-2 text-sm text-red-600" id="{{$name}}-error">{{$message}}</p>
    @else
    <p class="mt-2 text-sm" id="{{$name}}-error">&nbsp;</p>
    @enderror

</div>