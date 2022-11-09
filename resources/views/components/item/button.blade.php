@props(['size'=>'default'])
@switch($size)
    @case('small')
    <button type="button" {{ $attributes->merge(['class' => 'rounded-full py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white
            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800']) }} >
       <span class="flex justify-center items-center">  {{$slot}} </span>
    </button>
    @break

    @case('default')
    <button type="button" {{ $attributes->merge(['class' => 'py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white
        hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800']) }}>
        {{$slot}}
    </button>
    @break

    @case('large')
    <button type="button" {{ $attributes->merge(['class' => 'py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white
        hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm sm:p-5 dark:focus:ring-offset-gray-800']) }}>
        {{$slot}}
    </button>
    @break
@endswitch



