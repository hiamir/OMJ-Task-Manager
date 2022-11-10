@props([
'wireName',
'updating'=>'defer',
'debounce'=>'500ms',
'size'=>'small',
'label',
'name',
'placeholder',
])

<div {{ $attributes->merge(['class']) }}>
    <x-item.label for="{{$name}}" label="{{$label}}"></x-item.label>
    <div class="relative">
        @switch($updating)
            @case('defer')
                <x-item.input wire:model.defer="{{$wireName}}" name="{{$name}}" placeholder="{{$placeholder}}" size="{{$size}}"></x-item.input>
            @break

            @case('lazy')
                <x-item.input wire:model.lazy="{{$wireName}}" name="{{$name}}" placeholder="{{$placeholder}}" size="{{$size}}"></x-item.input>
            @break

            @case('debounce')
                <x-item.input wire:model.debounce.500ms="{{$wireName}}" name="{{$name}}" placeholder="{{$placeholder}}" size="{{$size}}"></x-item.input>
            @break

            @default
             <x-item.input wire:model="{{$wireName}}" name="{{$name}}" placeholder="{{$placeholder}}" size="{{$size}}"></x-item.input>
            @break

            @endswitch


        {{-- Input error svg icon        --}}
{{--        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none pr-3">--}}
{{--            <x-svg.exclamation class="text-red-600"></x-svg.exclamation>--}}
{{--        </div>--}}
    </div>
    <x-item.validation-error name="{{$wireName}}"></x-item.validation-error>
</div>
