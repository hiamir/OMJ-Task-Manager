{{--@props(['active'])--}}

{{--@php--}}
{{--$classes = ($active ?? false)--}}
{{--            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-oblue-400 dark:border-oyellow-900 text-sm font-medium leading-5 text-oblue-600 dark:text-gray-200 focus:outline-none focus:border-oblue-700 transition'--}}
{{--            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-oblue-600 hover:text-gray-700 dark:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';--}}
{{--@endphp--}}
<a {{ $attributes->merge(['class' =>'flex-none lg:mt-1  !ml-2 sm:text-lg lg:text-md font-semibold dark:text-gray-200']) }}  aria-label="Task Manager"> {{ $slot }}</a>
{{--<a {{ $attributes->merge(['class' => $classes]) }}>--}}
{{--    {{ $slot }}--}}
{{--</a>--}}
