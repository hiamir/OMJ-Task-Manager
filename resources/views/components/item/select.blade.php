@props([
'name'=>'',
'placeholder'=>'',
'data'=>[],
'size'=>'small',
'sizeSmall'=>'disabled py-2 px-3 pr-9 text-sm block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-300 dark:border-gray-700 dark:text-gray-400 invalid:text-red-500',
'sizeMedium'=>'py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-300 dark:border-gray-700 dark:text-gray-400 sm:p-4',
'sizeLarge'=>'py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-oblue-300 dark:border-gray-700 dark:text-gray-400 sm:p-5',

])


<div class="relative" >
    <select id="{{$name}}"
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
        @if($placeholder !== '')
        @if(count($data) > 0)
        <option hidden selected value=null>{{$placeholder}}</option>
        @else
            <option hidden selected value=null>Not parent menu available</option>
            @endif
        @endif
        @foreach($data as $key=>$value)
            <option id="{{$key}}" value="{{$key}}">{{$value}}</option>
       @endforeach
    </select>
</div>
