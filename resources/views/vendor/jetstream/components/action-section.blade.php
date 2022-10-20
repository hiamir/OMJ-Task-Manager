<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-form-side-header title={{$title}} description={{$description}}></x-form-side-header>


    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white dark:bg-oblue-400  shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
