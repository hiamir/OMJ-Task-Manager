@props([
'name'=>'',
'placeholder'=>'',
'size'=>'small',
'sizeSmall'=>'py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-300 dark:border-olblue-800/[0.5] dark:text-gray-400',
'sizeMedium'=>'py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-800 dark:border-gray-700 dark:text-gray-400',
'sizeLarge'=>'y-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-800 dark:border-gray-700 dark:text-gray-400 sm:p-5',

])
<input {{ $attributes->merge() }} type="text" id="{{$name}}" placeholder="{{$placeholder}}" name="{{$name}}"
@switch($size)
    @case('small')
        {{ $attributes->merge(['class' => $sizeSmall])}}
    @break

        @case('medium')
        {{ $attributes->merge(['class' => $sizeMedium])}}
        @break

        @case('large')
        {{ $attributes->merge(['class' => $sizeLarge])}}
        @break
@endswitch

>
