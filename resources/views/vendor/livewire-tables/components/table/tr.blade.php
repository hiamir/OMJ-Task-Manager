@aware(['component'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->id]);
    $theme = $component->getTheme();
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

@if ($theme === 'tailwind')
    <tr
        wire:loading.class.delay="opacity-50 dark:bg-oblue-700 dark:border-oblue-100 dark:opacity-60"

        @if ($component->reorderIsEnabled() && $component->currentlyReorderingIsEnabled())
            wire:sortable.item="{{ $row->getKey() }}"
        @endif

        {{
            $attributes->merge($customAttributes)
                ->class(['transition-all duration-300 bg-white dark:bg-oblue-400 dark:text-white' => ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0])
                ->class(['transition-all duration-300 bg-gray-50 dark:bg-oblue-500 dark:text-white' => ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0])
                ->class(['cursor-pointer' => $component->hasTableRowUrl()])
                ->except('default')
        }}
    >
        {{ $slot }}
    </tr>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <tr
        wire:loading.class.delay=""

        @if ($component->reorderIsEnabled() && $component->currentlyReorderingIsEnabled())
            wire:sortable.item="{{ $row->getKey() }}"
        @endif

        {{
            $attributes->merge($customAttributes)
                ->class(['' => ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0])
                ->class(['' => ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0])
                ->except('default')
        }}
    >
        {{ $slot }}
    </tr>
@endif
