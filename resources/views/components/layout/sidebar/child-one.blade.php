@props(['id'=>null, 'name'=>null , 'childCount'=>0])
@if($id != null)
    <li class="hs-accordion" id="{{$id}}">
        <a {{ $attributes->merge(['class' => 'hs-accordion-toggle cursor-pointer flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700
rounded-md hover:bg-slate-100  dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white']) }} >
            @switch($name)
                @case('Users')
                <x-svg.users></x-svg.users>
                {{ __($name) }}
                @break

{{--                @case('Menu')--}}
{{--                <x-svg.menu></x-svg.menu>--}}
{{--                {{ __($name) }}--}}
{{--                @break--}}

                @default
                {{ __($name) }}
                @break
            @endswitch
            @if($childCount > 0) <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction> @endif
        </a>
        <div id="{{$id}}"
             class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
            {{$slot}}
        </div>
    </li>
@else
    <li>
        <a {{ $attributes->merge(['class' => 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500']) }} href="route($href)">
            @switch($name)
                @case('Dashboard')
                <x-svg.home></x-svg.home>
                {{ __($name) }}
                @break

                @case('Users')
                <x-svg.users></x-svg.users>
                {{ __($name) }}
                @break

                @case('Menu')
                <x-svg.menu></x-svg.menu>
                {{ __($name) }}
                @break

                @default
                {{ __($name) }}
                @break
            @endswitch
        </a>
    </li>
@endif

