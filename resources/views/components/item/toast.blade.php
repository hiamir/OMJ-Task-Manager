
<div class="absolute bottom-10 right-10 "
     x-show="toast.show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
>
    {{--    Normal Message  --}}
    <template x-if="toast.type==='normal'">

        <div x-show="toast.type==='normal'" class="max-w-xs min-w-[300px] bg-white border rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700" role="alert">
            <div class="flex p-4">
                <div class="flex-shrink-0">
                    <x-svg.information class="h-4 w-4 text-blue-500 mt-0.5"></x-svg.information>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-400" x-text="toast.message"> </p>
                </div>
            </div>
        </div>
    </template>

    {{--    Success Message  --}}
    <template x-if="toast.type==='success'">
        <div x-show="toast.type==='success'" class="max-w-xs min-w-[300px] bg-white border rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700" role="alert">
            <div class="flex p-4">
                <div class="flex-shrink-0">
                    <x-svg.checked-circle class="h-4 w-4 text-green-500 mt-0.5"></x-svg.checked-circle>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-400" x-text="toast.message"></p>
                </div>
            </div>
        </div>
    </template>

    {{--    Error Message  --}}
    <template x-if="toast.type==='error'">
        <div x-show="toast.type==='error'" class="max-w-xs min-w-[300px] bg-white border rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700" role="alert">
            <div class="flex p-4">
                <div class="flex-shrink-0">
                    <x-svg.cross-circle class="h-4 w-4 text-red-500 mt-0.5"></x-svg.cross-circle>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-400" x-text="toast.message"></p>
                </div>
            </div>
        </div>
    </template>

        {{--    Warning Message  --}}
    <template x-if="toast.type==='warning'">
        <div x-show="toast.type==='warning'" class="max-w-xs min-w-[300px] bg-white border rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700" role="alert">
            <div class="flex p-4">
                <div class="flex-shrink-0">
                    <x-svg.cross-circle class="h-4 w-4 text-orange-500 mt-0.5"></x-svg.cross-circle>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-700 dark:text-gray-400" x-text="toast.message"></p>
                </div>
            </div>
        </div>
    </template>
</div>
