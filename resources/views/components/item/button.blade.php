@props([
'size'=>'medium',
'type'=>'button',
'formType'=>'default',
'defaultBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-oblue-100 dark:hover:bg-oblue-100 dark:border-olblue-800/[0.5] dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-oblue-100',
'primaryBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-blue-600 text-gray-100 shadow-sm align-middle hover:bg-blue-700 border-blue-700 dark:border-blue-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-300 transition-all text-sm dark:bg-blue-700 dark:hover:bg-blue-800 dark:border-blue-600/[0.5] dark:text-blue-200 dark:hover:text-white dark:focus:ring-offset-blue-100',
'successBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-green-600 text-gray-100 shadow-sm align-middle hover:bg-green-700 border-green-700 dark:border-green-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-300 transition-all text-sm dark:bg-green-700 dark:hover:bg-green-800 dark:border-green-600/[0.5] dark:text-green-200 dark:hover:text-white dark:focus:ring-offset-oblue-100',
'dangerBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-red-600 text-gray-100 shadow-sm align-middle hover:bg-red-700 border-red-700 dark:border-red-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-red-300 transition-all text-sm dark:bg-red-700 dark:hover:bg-red-800 dark:border-red-600/[0.5] dark:text-red-200 dark:hover:text-white dark:focus:ring-offset-red-100'
])
<div class="flex">
@switch($size)
    @case('small')

    @if($formType==='create')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $successBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='update')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $primaryBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='delete')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $dangerBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @else
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $defaultBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @endif

    @break

    @case('medium')

    @if($formType==='create')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $successBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='update')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $primaryBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='delete')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $dangerBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @else
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $defaultBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @endif

    @break

    @case('large')
    @if($formType==='create')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $successBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='update')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $primaryBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @elseif($formType==='delete')
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $dangerBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @else
        <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $defaultBg]) }} >
            <span class="flex justify-center items-center">  {{$slot}} </span>
        </button>
    @endif
    @break
@endswitch
</div>


