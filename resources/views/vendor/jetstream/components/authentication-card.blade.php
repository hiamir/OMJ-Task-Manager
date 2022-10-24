@props(['guard'=>'web'])
<div x-data="{guard:null}"
x-init="
        guard='{{$guard}}'
    "
>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-oblue-600"

>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-oblue-100 shadow-md overflow-hidden sm:rounded-lg"
{{--         :class="{ 'bg-red-700 dark:bg-red-900/[0.8]': guard='admin' }"--}}
    >
        {{ $slot }}
    </div>
</div>
</div>
