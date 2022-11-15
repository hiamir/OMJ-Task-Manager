@props([
'wireName',
'size'=>'small',
'label',
'name',
'placeholder',
'data'=>[]
])

<div {{ $attributes->merge(['class']) }}>
    <x-item.label for="{{$name}}" label="{{$label}}"></x-item.label>
    <x-item.select wire:model="{{$wireName}}" name="{{$name}}" placeholder="{{$placeholder}}" :data=$data size="{{$size}}"></x-item.select>
    <x-item.validation-error name="{{$wireName}}"></x-item.validation-error>
</div>
