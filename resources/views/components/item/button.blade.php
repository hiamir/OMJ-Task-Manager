@props([
'size'=>'medium',
'type'=>'button',
'defaultBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-oblue-100 dark:hover:bg-oblue-100 dark:border-olblue-800/[0.5] dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-oblue-100',
'primaryBg'=>'transition-all duration-300 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-blue-600 text-gray-100 shadow-sm align-middle hover:bg-blue-700 border-blue-700 dark:border-blue-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-300 transition-all text-sm '
])
@switch($size)
    @case('small')
        @if($type==='submit')
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $primaryBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @else
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-2 px-3 '. $defaultBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @endif
    @break

    @case('medium')
        @if($type==='submit')
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $primaryBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @else
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $defaultBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @endif
    @break

    @case('large')
        @if($type==='submit')
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $primaryBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @else
            <button type={{$type}} {{ $attributes->merge(['class' =>'py-3 px-4 '. $defaultBg]) }} >
                <span class="flex justify-center items-center">  {{$slot}} </span>
            </button>
        @endif
    @break
@endswitch



