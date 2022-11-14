@props(['formType'=>'none','name'])
<div class="flex justify-end mt-4 pt-4 items-center gap-x-2 py-3 px-0 pb-0 p border-t dark:border-olblue-800/[0.5]">
    <x-item.button @click.prevent="isFirstModelButtonClicked = false" size="small">
        Close
    </x-item.button>

    <x-item.button formType={{$formType}} type="submit" size="small">
        {{$name}}
    </x-item.button>
</div>
