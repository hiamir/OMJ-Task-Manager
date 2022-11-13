@props([
'type',
'size'=>'small',
'buttonName'=>'Give some name',
'modalHeader'=>'Give a header',
'smallModal'=>'sm:max-w-lg sm:w-full ',
'mediumModal'=>'md:max-w-2xl md:w-full ',
'largeModal'=>'lg:max-w-4xl lg:w-full ',
])

<x-item.button @click.prevent="isFirstModelButtonClicked = true; $wire.resetForm()" size="small">
    @switch($type)
        @case('create')
        <x-svg.add class="flex w-4 h-4"></x-svg.add>
        @break

        @case('update')
        <x-svg.edit class="flex w-4 h-4"></x-svg.edit>
        @break

        @case('delete')
        <x-svg.add class="flex w-4 h-4"></x-svg.add>
        @break
    @endswitch

    <span class="flex ml-1">{{__($buttonName)}}</span>
</x-item.button>


<div id="hs-vertically-centered-scrollable-modal"
     class="hs-overlay  transition-all duration-300 opacity-0 w-full h-full fixed top-0 left-0 z-[80] overflow-x-hidden overflow-y-auto ustify-center items-center"
     :class="{ 'block opacity-100 transition-all duration-300 ': isFirstModelButtonClicked === true, ' opacity-0 transition-all duration-300 hidden': isFirstModelButtonClicked===false  }"
>
    <div
        @switch($size)

        @case('small')
        {{ $attributes->merge(['class' => $smallModal.'opacity-0  m-3 sm:mx-auto h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex justify-center items-center' ]) }}
        @break

        @case('medium')
        {{ $attributes->merge(['class' => $mediumModal.'opacity-0  m-3 sm:mx-auto h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex justify-center items-center' ]) }}
        @break

        @case('large')
        {{ $attributes->merge(['class' => $largeModal.'opacity-0  m-3 sm:mx-auto h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex justify-center items-center' ]) }}
        @break

        @endswitch

        :class="{ '!flex transition-all duration-300 opacity-100 ': isFirstModelButtonClicked===true }"
    >
        <div
            class="max-h-full !min-w-full overflow-hidden flex flex-col bg-white border shadow-sm rounded-xl dark:bg-oblue-300 dark:border-oblue-100 dark:shadow-olblue-900/[.5]">
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-olblue-800/[0.5]">
                <h3 class="flex justify-start items-center font-bold text-gray-800 dark:text-white">
                    @switch($type)
                        @case('create')
                        <x-svg.add class="flex w-5 h-5"></x-svg.add>
                        @break

                        @case('update')
                        <x-svg.add class="flex w-5 h-5"></x-svg.add>
                        @break

                        @case('delete')
                        <x-svg.add class="flex w-5 h-5"></x-svg.add>
                        @break
                    @endswitch

                    <span class="flex ml-1">{{$modalHeader}}</span>

                </h3>

                <x-item.button @click.prevent="isFirstModelButtonClicked = false" size="small"
                               class="border-0 !bg-transparent ">
                    <span class="sr-only">Close</span>
                    <x-svg.close></x-svg.close>
                </x-item.button>
            </div>
            {{$slot}}
        </div>
    </div>
</div>
